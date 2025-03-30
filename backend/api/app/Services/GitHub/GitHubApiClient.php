<?php

namespace App\Services\GitHub;

use App\Services\GitHub\DTOs\RepositoryDTO;
use App\Services\GitHub\DTOs\PullRequestDTO;
use App\Services\GitHub\Exceptions\GitHubApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GitHubApiClient
{
    private string $baseUrl = 'https://api.github.com';
    private string $token;
    private int $rateLimitRemaining = 5000;
    private int $rateLimitReset = 0;

    public function __construct()
    {
        $this->token = config('services.github.token');

        if (empty($this->token)) {
            throw new GitHubApiException('GitHub API token is not configured');
        }
    }

    /**
     * リポジトリ情報を取得
     *
     * @param string $owner
     * @param string $repository
     * @return RepositoryDTO
     */
    public function getRepository(string $owner, string $repository ): RepositoryDTO
    {
        $cacheKey = "github_repo_{$owner}_{$repository}";
        $cacheTtl = 3600;

        return Cache::remember($cacheKey, $cacheTtl, function () use ($owner, $repository) {
            $response = $this->makeRequest("repos/{$owner}/{$repository}");
            return new RepositoryDTO($response);
        });
    }

    /**
     * プルリクエスト一覧を取得
     *
     * @param string $owner
     * @param string $repository
     * @param array $params
     * @return array
     */
    public function getPullRequests(string $owner, string $repository, array $params = []): array
    {
        $defaultParams = [
            'state' => 'all',
            'per_page' => 100,
        ];

        $params = array_merge($defaultParams, $params);
        $cacheKey = "github_pulls_{$owner}_{$repository}_" . md5(json_encode($params));
        $cacheTtl = 1800;

        return Cache::remember($cacheKey, $cacheTtl, function () use ($owner, $repository, $params) {
            $response = $this->makeRequest("repos/{$owner}/{$repository}/pulls", $params);

            return array_map(function ($pullRequest) {
                return new PullRequestDTO($pullRequest);
            }, $response);
        });
    }

    /**
     * プルリクエストの詳細を取得
     *
     * @param string $owner
     * @param string $repository
     * @param int $number
     * @return PullRequestDTO
     */
    public function getPullRequest(string $owner, string $repository, int $number): PullRequestDTO
    {
        $cacheKey = "github_pull_{$owner}_{$repository}_{$number}";
        $cacheTtl = 3600;
        return Cache::remember($cacheKey, $cacheTtl, function () use ($owner, $repository, $number) {
            $response = $this->makeRequest("repos/{$owner}/{$repository}/pulls/{$number}");
            return new PullRequestDTO($response);
        });
    }

    /**
     * プルリクエストのレビューを取得
     *
     * @param string $owner
     * @param string $repository
     * @param int $number
     * @return array
     */
    public function getPullRequestReviews(string $owner, string $repository, int $number): array
    {
        $cacheKey = "github_pull_reviews_{$owner}_{$repository}_{$number}";
        $cacheTtl = 3600;
        return Cache::remember($cacheKey, $cacheTtl, function () use ($owner, $repository, $number) {
            return $this->makeRequest("repos/{$owner}/{$repository}/pulls/{$number}/reviews");
        });
    }

    /**
     * リポジトリのコラボレーターを取得
     *
     * @param string $owner
     * @param string $repository
     * @return array
     */
    public function getCollaborators(string $owner, string $repository): array
    {
        $cacheKey = "github_collaborators_{$owner}_{$repository}";
        $cacheTtl = 86400;
        return Cache::remember($cacheKey, $cacheTtl, function () use ($owner, $repository) {
            $response = $this->makeRequest("repos/{$owner}/{$repository}/collaborators");
            return $response;
        });
    }

    /**
     * API制限状況を取得
     *
     * @return array
     */
    public function getRateLimit(): array
    {
        $response = $this->makeRequest('rate_limit');
        return $response['resources']['core'];
    }

    /**
     * APIリクエストを実行
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    private function makeRequest(string $endpoint, array $params = []): array
    {
        // レート制限が近づいていたら警告
        if ($this->rateLimitRemaining < 10) {
            Log::warning("GitHub API rate limit is low: {$this->rateLimitRemaining} remaining");

            // 残り少ない場合はリセット時間までキャッシュに頼る
            if ($this->rateLimitRemaining < 3 && time() < $this->rateLimitReset) {
                throw new GitHubApiException(
                    "GitHub API rate limit nearly exhausted. Resets at " .
                    date('Y-m-d H:i:s', $this->rateLimitReset)
                );
            }
        }

        // リクエスト実行
        $response = Http::withHeaders([
            'Authorization' => "token {$this->token}",
            'Accept' => 'application/vnd.github.v3+json',
        ])->get("{$this->baseUrl}/{$endpoint}", $params);

        // レート制限情報を更新
        if ($response->header('X-RateLimit-Remaining')) {
            $this->rateLimitRemaining = (int) $response->header('X-RateLimit-Remaining');
            $this->rateLimitReset = (int) $response->header('X-RateLimit-Reset');
        }

        // エラーハンドリング
        if ($response->failed()) {
            // 401エラーの場合は認証エラー
            if ($response->status() === 401) {
                throw new GitHubApiException("GitHub API authentication failed. Check your token.");
            }

            // 403エラーでレート制限の場合
            if ($response->status() === 403 && $this->rateLimitRemaining === 0) {
                $resetTime = date('Y-m-d H:i:s', $this->rateLimitReset);
                throw new GitHubApiException(
                    "GitHub API rate limit exceeded. Resets at {$resetTime}"
                );
            }

            // その他のエラー
            throw new GitHubApiException(
                "GitHub API request failed: {$response->status()} - {$response->body()}"
            );
        }

        return $response->json();
    }
}
