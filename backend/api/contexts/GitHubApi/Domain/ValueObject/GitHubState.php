<?php

namespace App\Contexts\GitHubApi\Domain\ValueObject;

use InvalidArgumentException;

readonly class GitHubState
{
    private const VALID_STATES = ['open', 'closed'];

    public function __construct(public string $value)
    {
        if (!in_array($value, self::VALID_STATES, true)) {
            throw new InvalidArgumentException('Invalid GitHub state. Must be one of: ' . implode(', ', self::VALID_STATES));
        }
    }

    public function isOpen(): bool
    {
        return $this->value === 'open';
    }

    public function isClosed(): bool
    {
        return $this->value === 'closed';
    }

    public function equals(GitHubState $other): bool
    {
        return $this->value === $other->value;
    }
}