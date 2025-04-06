<?php
use App\Http\Controllers\GitHub\ImportCollaboratorController;
use Illuminate\Support\Facades\Route;

Route::prefix('github')->group(function () {
    Route::post('/collaborators/{owner}/{repository}', ImportCollaboratorController::class);
});
