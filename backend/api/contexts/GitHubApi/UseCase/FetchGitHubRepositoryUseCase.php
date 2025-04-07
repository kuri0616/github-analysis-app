<?php

    namespace App\Contexts\GitHubApi\UseCase;

    use App\Contexts\GitHubApi\Domain\Repository\IGitHubRepositoryRepository;
    use Illuminate\Support\Collection;

    class FetchGitHubRepositoryUseCase
    {
        public function __construct(
            private readonly IGitHubRepositoryRepository $repository
        )
        {
        }

        public function handle(): Collection
        {
            // TODO: コントローラーに受け渡す用のDTOを作る
            return $this->repository->fetchAll();
        }
    }
