<?php

namespace App\Http\Controllers\GitHub;

use App\Contexts\GitHubApi\UseCase\FetchRepositoryVulnerabilitiesUseCase;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchRepositoryVulnerabilitiesController extends Controller
{
    public function __construct(
        private readonly FetchRepositoryVulnerabilitiesUseCase $useCase
    )
    {
    }

    /**
     * リポジトリの脆弱性情報を取得するAPI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $repositoryId = $request->route('repositoryId');
            
            $vulnerabilities = $this->useCase->handle($repositoryId);
            $summary = $this->useCase->getVulnerabilitySummary($repositoryId);

            return response()->json([
                'success' => true,
                'data' => [
                    'vulnerabilities' => $vulnerabilities,
                    'summary' => $summary,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching vulnerabilities: ' . $e->getMessage(),
            ], 500);
        }
    }
}
