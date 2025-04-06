<?php

namespace App\Http\Controllers\GitHub;

use App\Constants\ApiMessages;
use App\Contexts\GitHubApi\Exception\GitHubApiException;
use App\Contexts\GitHubApi\UseCase\ImportCollaboratorsUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\GitHub\ImportCollaboratorsRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class ImportCollaboratorController extends Controller
{
    /**
     * GitHubのコラボレーター情報を取得・保存するAPI
     *
     * @param ImportCollaboratorsRequest $request
     * @param ImportCollaboratorsUseCase $useCase
     * @return JsonResponse
     */
    public function __invoke(ImportCollaboratorsRequest $request, ImportCollaboratorsUseCase $useCase): JsonResponse
    {
        try {

Log::debug('ImportCollaboratorController');
            $result = $useCase->handle(
                $request->route('owner'),
                $request->route('repository')
            );

            return response()->json([
                'success' => true,
                'message' => ApiMessages::COLLABORATORS_IMPORTED_SUCCESS,
                'total_count' => $result['total_count']
            ]);
        } catch (GitHubApiException $e) {
            return response()->json([
                'success' => false,
                'message' => ApiMessages::GITHUB_API_ERROR_PREFIX . $e->getMessage(),
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => ApiMessages::GENERAL_ERROR_PREFIX . $e->getMessage(),
            ], 500);
        }
    }
}
