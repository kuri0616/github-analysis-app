<?php

namespace App\Contexts\GitHubApi\Domain\Entity;

use App\Contexts\GitHubApi\Domain\ValueObject\GitHubId;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubState;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubUrl;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubTimestamp;

class PullRequest
{
    public function __construct(
        public readonly GitHubId $id,
        public readonly int $pullRequestNumber,
        public readonly GitHubId $repositoryId,
        public readonly string $title,
        public readonly GitHubState $state,
        public readonly ?GitHubId $userId,
        public readonly ?string $body,
        public readonly GitHubTimestamp $createdAt,
        public readonly GitHubTimestamp $updatedAt,
        public readonly ?GitHubTimestamp $closedAt,
        public readonly ?GitHubTimestamp $mergedAt,
        public readonly GitHubUrl $htmlUrl,
        public readonly int $commitsCount = 0,
        public readonly int $additionsCount = 0,
        public readonly int $deletionsCount = 0,
        public readonly int $changedFilesCount = 0,
    ) {
    }

    public function isMerged(): bool
    {
        return $this->mergedAt !== null;
    }

    public function getDurationInHours(): ?float
    {
        if ($this->mergedAt === null && $this->closedAt === null) {
            return null;
        }

        $endDate = $this->mergedAt ?? $this->closedAt;
        return $this->createdAt->getDifferenceInHours($endDate);
    }

    public function isFromRepository(GitHubId $repositoryId): bool
    {
        return $this->repositoryId->equals($repositoryId);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'pull_request_number' => $this->pullRequestNumber,
            'repository_id' => $this->repositoryId->getValue(),
            'title' => $this->title,
            'state' => $this->state->getValue(),
            'user_id' => $this->userId?->getValue(),
            'body' => $this->body,
            'html_url' => $this->htmlUrl->getValue(),
            'created_at' => $this->createdAt->getFormattedValue(),
            'updated_at' => $this->updatedAt->getFormattedValue(),
            'closed_at' => $this->closedAt?->getFormattedValue(),
            'merged_at' => $this->mergedAt?->getFormattedValue(),
            'commits_count' => $this->commitsCount,
            'additions_count' => $this->additionsCount,
            'deletions_count' => $this->deletionsCount,
            'changed_files_count' => $this->changedFilesCount,
        ];
    }
} 