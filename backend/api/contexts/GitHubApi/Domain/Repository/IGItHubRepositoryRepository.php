<?php

    namespace App\Contexts\GitHubApi\Domain\Repository;

    use Illuminate\Support\Collection;

    interface IGitHubRepositoryRepository
    {
        /**
         * @return Collection
         */
        public function fetchAll(): Collection;
    }
