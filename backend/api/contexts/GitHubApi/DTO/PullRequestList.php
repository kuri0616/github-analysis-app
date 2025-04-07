<?php

    namespace App\Contexts\GitHubApi\DTO;
    readonly class PullRequestList
    {
        /**
         * @var PullRequest[]
         */
        public array $values;

        public function __construct(PullRequest ...$pullRequests)
        {
            $this->values = $pullRequests;
        }

        public function filterByRepositoryId(int $repositoryId): PullRequestList
        {
            $filtered = array_filter(
                $this->values,
                fn(PullRequest $pr) => $pr->isFromRepository($repositoryId)
            );

            return new PullRequestList(...array_values($filtered));
        }
    }
