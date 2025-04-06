<?php

namespace App\Contexts\GitHubApi\Infra\Repository;

use App\Contexts\GitHubApi\Domain\Repository\IGitHubCollaboratorRepository;
use App\Contexts\GitHubApi\DTO\UserCollection;
use App\Models\GitHubUser;

class GitHubCollaboratorRepository implements IGitHubCollaboratorRepository
{

    public function __construct()
    {
    }

    /**
     * コラボレーター情報を保存する
     *
     * @param UserCollection $collaborators
     * @return int // 保存したレコード数
     */
    public function save(UserCollection $collaborators): int
    {
        $collaboratorsParams = array_map(function ($collaborator) {
            return [
                'id' => $collaborator->id,
                'login' => $collaborator->login,
                'avatar_url' => $collaborator->avatarUrl,
                'html_url' => $collaborator->htmlUrl,
                'name' => $collaborator->name,
                'email' => $collaborator->email,
                'bio' => $collaborator->bio,
                ];
            }, $collaborators->toArray());

        return GitHubUser::upsert(
            $collaboratorsParams,
            ['id'],
            ['login', 'avatar_url', 'html_url', 'name', 'email', 'bio']
        );
    }
}
