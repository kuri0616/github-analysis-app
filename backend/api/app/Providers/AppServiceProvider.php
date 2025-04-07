<?php

    namespace App\Providers;

    use App\Contexts\GitHubApi\Domain\Repository\IGitHubCollaboratorRepository;
    use App\Contexts\GitHubApi\Domain\Repository\IGitHubPullRequestRepository;
    use App\Contexts\GitHubApi\Domain\Repository\IGitHubRepositoryRepository;
    use App\Contexts\GitHubApi\Infra\GitHubApiClient;
    use App\Contexts\GitHubApi\Infra\Repository\GitHubCollaboratorRepository;
    use App\Contexts\GitHubApi\Infra\Repository\GitHubPullRequestRepository;
    use App\Contexts\GitHubApi\Infra\Repository\GitHubRepositoryRepository;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            $this->app->singleton(GitHubApiClient::class, function ($app) {
                return new GitHubApiClient();
            });

            $this->app->bind(IGitHubCollaboratorRepository::class, GitHubCollaboratorRepository::class);

            $this->app->bind(IGitHubPullRequestRepository::class, GitHubPullRequestRepository::class);

            $this->app->bind(IGitHubRepositoryRepository::class, GitHubRepositoryRepository::class);
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            //
        }
    }
