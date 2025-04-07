<?php

    namespace App\Contexts\GitHubApi\DTO;

    use DateTime;

    class PullRequest
    {
        public int $id;
        public int $pullRequestNumber;
        public int $repositoryId;
        public string $title;
        public string $state;
        public bool $locked;
        public ?User $user;
        public string $body;
        public string $createdAt;
        public string $updatedAt;
        public ?string $closedAt;
        public ?string $mergedAt;
        public string $htmlUrl;
        public ?array $labels;
        public int $commentsCount;
        public int $reviewCommentsCount;
        public int $commitsCount;
        public int $additionsCount;
        public int $deletionsCount;
        public int $changedFilesCount;

        public function __construct(array $data)
        {
            $this->id = $data['id'];
            $this->pullRequestNumber = $data['number'];
            $this->repositoryId = $data['head']['repo']['id'] ?? 0;
            $this->title = $data['title'];
            $this->state = $data['state'];
            $this->locked = $data['locked'];
            $this->user = isset($data['user']) ? new User($data['user']) : null;
            $this->body = $data['body'] ?? '';
            $this->createdAt = $data['created_at'];
            $this->updatedAt = $data['updated_at'];
            $this->closedAt = $data['closed_at'] ?? null;
            $this->mergedAt = $data['merged_at'] ?? null;
            $this->htmlUrl = $data['html_url'];
            $this->labels = $data['labels'] ?? null;

            // これらのフィールドは詳細を取得したときのみ存在
            $this->commentsCount = $data['comments'] ?? 0;
            $this->reviewCommentsCount = $data['review_comments'] ?? 0;
            $this->commitsCount = $data['commits'] ?? 0;
            $this->additionsCount = $data['additions'] ?? 0;
            $this->deletionsCount = $data['deletions'] ?? 0;
            $this->changedFilesCount = $data['changed_files'] ?? 0;
        }

        public function toArray(): array
        {
            return [
                'github_id' => $this->id,
                'pull_request_number' => $this->pullRequestNumber,
                'number' => $this->pullRequestNumber,
                'repository_id' => $this->repositoryId,
                'title' => $this->title,
                'state' => $this->state,
                'locked' => $this->locked,
                'user' => $this->user,
                'body' => $this->body,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'closed_at' => $this->closedAt,
                'merged_at' => $this->mergedAt,
                'html_url' => $this->htmlUrl,
                'comments_count' => $this->commentsCount,
                'review_comments_count' => $this->reviewCommentsCount,
                'commits_count' => $this->commitsCount,
                'additions_count' => $this->additionsCount,
                'deletions_count' => $this->deletionsCount,
                'changed_files_count' => $this->changedFilesCount,
            ];
        }

        /**
         * プルリクエストがマージされているかどうかを返す
         *
         * @return bool
         */
        public function isMerged(): bool
        {
            return $this->mergedAt !== null;
        }

        /**
         * プルリクエストが開かれてからマージされるまでの時間を時間単位で返す
         *
         * @return float|null
         */
        public function getDurationInHours(): ?float
        {
            if ($this->mergedAt === null && $this->closedAt === null) {
                return null;
            }
            $endDate = $this->mergedAt ?? $this->closedAt;
            $start = new DateTime($this->createdAt);
            $end = new DateTime($endDate);
            $diff = $end->diff($start);

            return ($diff->days * 24) + $diff->h + ($diff->i / 60);
        }

        public function isFromRepository(int $repositoryId): bool
        {
            return $this->repositoryId === $repositoryId;
        }
    }
