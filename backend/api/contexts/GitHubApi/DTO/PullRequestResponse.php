<?php

namespace App\Contexts\GitHubApi\DTO;

readonly class PullRequestResponse
{
    /**
     * @param int $id
     * @param int $number
     * @param string $title
     * @param string|null $body
     * @param string $state
     * @param int $userId
     * @param string $htmlUrl
     * @param string $createdAt
     * @param string $updatedAt
     * @param string|null $closedAt
     * @param string|null $mergedAt
     * @param array $reviews
     */
    public function __construct(
        public int $id,
        public int $number,
        public string $title,
        public ?string $body,
        public string $state,
        public int $userId,
        public string $htmlUrl,
        public string $createdAt,
        public string $updatedAt,
        public ?string $closedAt,
        public ?string $mergedAt,
        public array $reviews
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'title' => $this->title,
            'body' => $this->body,
            'state' => $this->state,
            'user_id' => $this->userId,
            'html_url' => $this->htmlUrl,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'closed_at' => $this->closedAt,
            'merged_at' => $this->mergedAt,
            'reviews' => $this->reviews
        ];
    }
} 