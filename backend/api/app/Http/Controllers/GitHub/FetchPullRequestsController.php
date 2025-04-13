<?php

namespace App\Http\Controllers\GitHub;

use App\Contexts\GitHubApi\UseCase\FetchPullRequestsUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class FetchPullRequestsController extends Controller
{
    public function __construct(
        private readonly FetchPullRequestsUseCase $useCase
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $pullRequests = $this->useCase->handle(
                $request->route('repositoryId')
            );

            return response()->json([
                'success' => true,
                'data' => $pullRequests
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'プルリクエストの取得に失敗しました'
            ], 500);
        }
    }
}
