<?php

namespace Tests\Feature\GitHub;

use App\Models\PullRequest;
use App\Models\Repository;
use App\Models\GitHubUser;
use App\Models\PullRequestReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FetchPullRequestsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_pull_requests_success(): void
    {
        // リポジトリとユーザーを作成
        $repository = Repository::factory()->create();
        $user = GitHubUser::factory()->create();

        // プルリクエストを作成
        $pullRequests = PullRequest::factory()
            ->count(3)
            ->for($repository)
            ->for($user, 'user')
            ->create();

        // レビューを作成
        foreach ($pullRequests as $pullRequest) {
            PullRequestReview::factory()
                ->count(2)
                ->for($pullRequest)
                ->create();
        }

        // APIを呼び出し
        $response = $this->getJson("/api/github/repositories/{$repository->id}/pull-requests");

        // レスポンスを検証
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'repository_id',
                        'user_id',
                        'pull_request_number',
                        'title',
                        'body',
                        'state',
                        'html_url',
                        'commits_count',
                        'additions_count',
                        'deletions_count',
                        'changed_files_count',
                        'created_at',
                        'updated_at',
                        'closed_at',
                        'merged_at',
                        'user' => [
                            'id',
                            'name',
                            'avatar_url',
                            'html_url',
                        ],
                        'reviews' => [
                            '*' => [
                                'id',
                                'pull_request_id',
                                'user_id',
                                'state',
                                'body',
                                'submitted_at',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ],
                ],
            ])
            ->assertJson([
                'success' => true,
            ]);

        // データの件数を検証
        $this->assertCount(3, $response->json('data'));
    }

    public function test_fetch_pull_requests_not_found(): void
    {
        // 存在しないリポジトリIDでAPIを呼び出し
        $response = $this->getJson('/api/github/repositories/999/pull-requests');

        // レスポンスを検証
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [],
            ]);
    }
} 