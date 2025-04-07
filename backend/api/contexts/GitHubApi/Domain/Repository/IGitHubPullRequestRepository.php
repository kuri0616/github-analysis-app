<?php

namespace App\Contexts\GitHubApi\Domain\Repository;
use App\Contexts\GitHubApi\DTO\PullRequestList;


interface IGitHubPullRequestRepository
{
    /**
     * プルリクエスト情報を保存する
     *
     * @param PullRequestList $pullRequestList
     * @return int // 保存したレコード数
     */
    public function save(PullRequestList $pullRequestList): int;
}
