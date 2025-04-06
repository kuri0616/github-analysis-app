<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contexts\GitHubApi\Infra\GitHubApiClient;
use App\Contexts\GitHubApi\Domain\Repository\IGitHubCollaboratorRepository;
use App\Contexts\GitHubApi\Infra\Repository\GitHubCollaboratorRepository;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
