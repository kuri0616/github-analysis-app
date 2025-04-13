<?php

namespace App\Contexts\GitHubApi\UseCase;

use App\Contexts\GitHubApi\Domain\Repository\IGitHubPullRequestRepository;

class FetchPullRequestsUseCase
{
    public function __construct(
        private readonly IGitHubPullRequestRepository $repository
    ) {}

    /**
     * リポジトリIDに紐づくプルリクエストを取得
     *
     * @param int $repositoryId
     * @return array
     */
    public function handle(int $repositoryId): array
    {
        return $this->repository->findByRepositoryId($repositoryId);
    }
}
