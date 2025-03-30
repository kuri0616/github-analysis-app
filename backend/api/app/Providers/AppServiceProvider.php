<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GitHub\GitHubApiClient;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
