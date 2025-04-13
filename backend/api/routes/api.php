<?php

use App\Http\Controllers\GitHub\FetchGitHubRepositoryController;
use App\Http\Controllers\GitHub\ImportCollaboratorController;
use App\Http\Controllers\GitHub\ImportPullRequestController;
use App\Http\Controllers\GitHub\FetchPullRequestsController;
use Illuminate\Support\Facades\Route;

Route::prefix('github')->group(function () {
    Route::post('/collaborators/{owner}/{repository}', ImportCollaboratorController::class);

    Route::post('/pull-requests/{owner}/{repository}', ImportPullRequestController::class);

    Route::get('/repositories', FetchGitHubRepositoryController::class);

    Route::get('/repositories/{repositoryId}/pull-requests', FetchPullRequestsController::class);
});
