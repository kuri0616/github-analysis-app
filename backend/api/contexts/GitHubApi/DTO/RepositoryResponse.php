<?php

namespace App\Contexts\GitHubApi\DTO;

readonly class RepositoryResponse
{
    /**
     * @param int $id
     * @param string $name
     * @param string $htmlUrl
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $htmlUrl
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'html_url' => $this->htmlUrl
        ];
    }
} 