<?php

use App\Http\Controllers\GitHub\FetchGitHubRepositoryController;
use App\Http\Controllers\GitHub\ImportCollaboratorController;
use App\Http\Controllers\GitHub\ImportPullRequestController;
use App\Http\Controllers\GitHub\FetchPullRequestsController;
use App\Http\Controllers\GitHub\ScanRepositoryVulnerabilitiesController;
use App\Http\Controllers\GitHub\FetchRepositoryVulnerabilitiesController;
use Illuminate\Support\Facades\Route;

Route::prefix('github')->group(function () {
    Route::post('/collaborators/{owner}/{repository}', ImportCollaboratorController::class);

    Route::post('/pull-requests/{owner}/{repository}', ImportPullRequestController::class);

    Route::get('/repositories', FetchGitHubRepositoryController::class);

    Route::get('/repositories/{repositoryId}/pull-requests', FetchPullRequestsController::class);

    // Vulnerability scanning routes
    Route::post('/vulnerabilities/{owner}/{repository}/scan', ScanRepositoryVulnerabilitiesController::class);
    
    Route::get('/repositories/{repositoryId}/vulnerabilities', FetchRepositoryVulnerabilitiesController::class);
});
