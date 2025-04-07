<?php

    namespace App\Http\Controllers\GitHub;

    use App\Contexts\GitHubApi\UseCase\FetchGitHubRepositoryUseCase;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Routing\Controller;

    class FetchGitHubRepositoryController extends Controller
    {
        public function __construct(
            private readonly FetchGitHubRepositoryUseCase $useCase
        )
        {
        }

        public function __invoke(): JsonResponse
        {
            $result = $this->useCase->handle();

            return response()->json($result);
        }
    }
