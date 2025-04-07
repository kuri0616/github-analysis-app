<?php

    namespace App\Contexts\GitHubApi\Infra\Repository;

    use App\Contexts\GitHubApi\Domain\Repository\IGitHubPullRequestRepository;
    use App\Contexts\GitHubApi\DTO\PullRequestList;
    use App\Models\PullRequest;
    use Illuminate\Support\Carbon;

    class GitHubPullRequestRepository implements IGitHubPullRequestRepository
    {
        public function __construct()
        {
        }

        public function save(PullRequestList $pullRequestList): int
        {
            $pullRequestsParams = array_map(function ($pullRequest) {
                return [
                    'github_id' => $pullRequest->id,
                    'author_login' => $pullRequest->user->login,
                    'author_github_id' => $pullRequest->user->id,
                    'repository_id' => $pullRequest->repositoryId,
                    'number' => $pullRequest->pullRequestNumber,
                    'title' => $pullRequest->title,
                    'body' => $pullRequest->body,
                    'state' => $pullRequest->state,
                    'html_url' => $pullRequest->htmlUrl,
                    'locked' => $pullRequest->locked,
                    'comments_count' => $pullRequest->commentsCount,
                    'review_comments_count' => $pullRequest->reviewCommentsCount,
                    'commits_count' => $pullRequest->commitsCount,
                    'additions_count' => $pullRequest->additionsCount,
                    'deletions_count' => $pullRequest->deletionsCount,
                    'changed_files_count' => $pullRequest->changedFilesCount,
                    'created_at' => Carbon::parse($pullRequest->createdAt)->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($pullRequest->updatedAt)->format('Y-m-d H:i:s'),
                    'closed_at' => Carbon::parse($pullRequest->closedAt)->format('Y-m-d H:i:s'),
                    'merged_at' => Carbon::parse($pullRequest->mergedAt)->format('Y-m-d H:i:s'),
                ];

            }, $pullRequestList->values);

            return PullRequest::upsert(
                $pullRequestsParams,
                ['github_id'],
                [
                    'title',
                    'repository_id',
                    'author_github_id',
                    'author_login',
                    'number',
                    'body',
                    'state',
                    'created_at',
                    'updated_at',
                    'closed_at',
                    'merged_at',
                    'html_url',
                    'locked',
                    'comments_count',
                    'review_comments_count',
                    'commits_count',
                    'additions_count',
                    'deletions_count',
                    'changed_files_count',
                ]
            );
        }
    }
