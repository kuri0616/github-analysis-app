<?php

namespace App\Contexts\GitHubApi\Domain\Entity;

use App\Contexts\GitHubApi\Domain\ValueObject\GitHubId;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubLogin;
use App\Contexts\GitHubApi\Domain\ValueObject\GitHubUrl;

class User
{
    public function __construct(
        public readonly GitHubId $id,
        public readonly GitHubLogin $login,
        public readonly GitHubUrl $avatarUrl,
        public readonly GitHubUrl $htmlUrl,
        public readonly ?string $name
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'login' => $this->login->getValue(),
            'avatar_url' => $this->avatarUrl->getValue(),
            'html_url' => $this->htmlUrl->getValue(),
            'name' => $this->name,
        ];
    }
} 