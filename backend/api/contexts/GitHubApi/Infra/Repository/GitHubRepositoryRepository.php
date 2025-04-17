<?php

    namespace App\Contexts\GitHubApi\Infra\Repository;

    use App\Contexts\GitHubApi\Domain\Repository\IGitHubRepositoryRepository;
    use App\Models\Repository;
    use Illuminate\Support\Collection;

    class GitHubRepositoryRepository implements IGitHubRepositoryRepository
    {
        public function __construct()
        {
        }

        public function fetchAll(): Collection
        {
            return Repository::query()
                ->select('id', 'name', 'html_url')
                ->get();
        }
    }
