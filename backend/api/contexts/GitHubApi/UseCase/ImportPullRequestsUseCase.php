<?php

    namespace App\Contexts\GitHubApi\UseCase;


    use App\Contexts\GitHubApi\Domain\Repository\IGitHubPullRequestRepository;
    use App\Contexts\GitHubApi\Infra\GitHubApiClient;
    use Exception;
    use Illuminate\Support\Facades\Log;

    readonly class ImportPullRequestsUseCase
    {
        public function __construct(
            private IGitHubPullRequestRepository $pullRequestRepository,
            private GitHubApiClient              $gitHubApiClient,
        )
        {
        }

        public function handle(string $owner, string $repository): array
        {
            try {
                $pullRequestNumbers = $this->gitHubApiClient->getPullRequestNumbers($owner, $repository);

                $pullRequestList = $this->gitHubApiClient->getPullRequests(
                    $owner,
                    $repository,
                    $pullRequestNumbers
                );

                // TODO: リポジトリIDはリポジトリ情報を取得するAPIを叩いて取得するようにする
                $filteredPullRequestList = $pullRequestList->filterByRepositoryId(697776738);

                $affectedRows = $this->pullRequestRepository->save($filteredPullRequestList);

                return [
                    'total_count' => $affectedRows,
                ];
            } catch (Exception $e) {
                Log::error($e, [
                    'owner' => $owner,
                    'repository' => $repository,
                ]);
                // TODO:レスポンスを担うクラスを作るまでは再スローで対応する
                throw $e;
            }
        }
    }
