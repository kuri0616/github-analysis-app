<?php

    namespace App\Contexts\GitHubApi\Infra\Client\DTO;
    
    use App\Contexts\GitHubApi\Infra\Client\DTO\PullRequest;
    
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

        public function toArray(): array
        {
            return array_map(fn(PullRequest $pr) => $pr->toArray(), $this->values);
        }
    }
