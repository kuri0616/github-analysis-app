<?php
namespace App\Contexts\GitHubApi\UseCase;

use App\Contexts\GitHubApi\Domain\Repository\IGitHubCollaboratorRepository;
use App\Contexts\GitHubApi\Infra\GitHubApiClient;
use Illuminate\Support\Facades\Log;
use Exception;



class ImportCollaboratorsUseCase
{
    private GitHubApiClient $githubClient;
    private IGitHubCollaboratorRepository $collaboratorRepository;

    public function __construct(
        GitHubApiClient $githubClient,
        IGitHubCollaboratorRepository $collaboratorRepository
    ){
        $this->githubClient = $githubClient;
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * GitHubからコラボレーター情報を取得してDBに保存
     *
     * @param string $owner
     * @param string $repository
     * @return array
     */
    public function handle(string $owner, string $repository): array
    {
        try {
            $collaborators = $this->githubClient->getCollaborators($owner, $repository);
            $affectedRows = $this->collaboratorRepository->save($collaborators);

            return [
                'total_count' => $affectedRows,
            ];
        } catch (Exception $e) {
            Log::error('GitHub API error: ' . $e->getMessage(), [
                'owner' => $owner,
                'repository' => $repository,
            ]);
            // TODO:レスポンスを担うクラスを作るまでは再スローで対応する
            throw $e;
        }
    }
}
