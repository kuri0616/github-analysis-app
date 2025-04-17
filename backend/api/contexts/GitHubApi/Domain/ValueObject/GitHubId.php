<?php

namespace App\Contexts\GitHubApi\Domain\ValueObject;

use InvalidArgumentException;

readonly class GitHubId
{
    public function __construct(public int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('GitHub ID must be a positive integer');
        }
    }

    public function equals(GitHubId $other): bool
    {
        return $this->value === $other->value;
    }
}