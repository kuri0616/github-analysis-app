<?php

namespace App\Contexts\GitHubApi\Domain\Repository;

use App\Contexts\GitHubApi\DTO\UserCollection;

interface IGitHubCollaboratorRepository
{
    /**
     * コラボレーター情報を保存する
     *
     * @param UserCollection $collaborators
     * @return int // 保存したレコード数
     */
    public function save(UserCollection $collaborators): int;
}
