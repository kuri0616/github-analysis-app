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
                ->with('user:id,name,avatar_url,html_url')
                ->select('id', 'name', 'description', 'is_private', 'user_id', 'html_url', 'created_at', 'updated_at')
                ->get();
        }
    }
