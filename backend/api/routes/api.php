<?php

    use App\Http\Controllers\GitHub\ImportCollaboratorController;
    use App\Http\Controllers\GitHub\ImportPullRequestController;
    use Illuminate\Support\Facades\Route;

    Route::prefix('github')->group(function () {
        Route::post('/collaborators/{owner}/{repository}', ImportCollaboratorController::class);

        Route::post('/pull-requests/{owner}/{repository}', ImportPullRequestController::class);
    });
