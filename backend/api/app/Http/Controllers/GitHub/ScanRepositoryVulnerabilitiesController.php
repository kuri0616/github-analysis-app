<?php

namespace App\Http\Controllers\GitHub;

use App\Constants\ApiMessages;
use App\Contexts\GitHubApi\Exception\GitHubApiException;
use App\Contexts\GitHubApi\UseCase\ScanRepositoryVulnerabilitiesUseCase;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScanRepositoryVulnerabilitiesController extends Controller
{
    public function __construct(
        private readonly ScanRepositoryVulnerabilitiesUseCase $useCase
    )
    {
    }

    /**
     * リポジトリの脆弱性スキャンを実行するAPI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $result = $this->useCase->handle(
                $request->route('owner'),
                $request->route('repository')
            );

            return response()->json([
                'success' => true,
                'message' => 'Vulnerability scan completed successfully',
                'data' => $result
            ]);
        } catch (GitHubApiException $e) {
            return response()->json([
                'success' => false,
                'message' => 'GitHub API Error: ' . $e->getMessage(),
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'General Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
