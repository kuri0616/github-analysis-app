<?php

namespace App\Contexts\GitHubApi\Domain\Command;

class FetchPullRequestsCommand
{
    public function __construct(
        private readonly int $repositoryId
    ) {
    }

    public function getRepositoryId(): int
    {
        return $this->repositoryId;
    }
} 