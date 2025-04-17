<?php

namespace App\Contexts\GitHubApi\Domain\ValueObject;

use InvalidArgumentException;

readonly class GitHubLogin
{
    public function __construct(public string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('GitHub login cannot be empty');
        }
        if (!preg_match('/^[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}$/i', $value)) {
            throw new InvalidArgumentException('Invalid GitHub login format');
        }
    }

    public function equals(GitHubLogin $other): bool
    {
        return $this->value === $other->value;
    }
}