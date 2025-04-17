<?php

namespace App\Contexts\GitHubApi\Domain\Entity;

use App\Contexts\GitHubApi\Domain\ValueObject\GitHubId;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubUrl;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubTimestamp;

class Repository
{
    public function __construct(
        public readonly GitHubId $id,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $isPrivate,
        public readonly ?GitHubId $ownerGithubId,
        public readonly GitHubUrl $htmlUrl,
        public readonly GitHubTimestamp $createdAt,
        public readonly GitHubTimestamp $updatedAt
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'name' => $this->name,
            'description' => $this->description,
            'is_private' => $this->isPrivate,
            'owner_github_id' => $this->ownerGithubId?->getValue(),
            'html_url' => $this->htmlUrl->getValue(),
            'created_at' => $this->createdAt->getFormattedValue(),
            'updated_at' => $this->updatedAt->getFormattedValue(),
        ];
    }
} 