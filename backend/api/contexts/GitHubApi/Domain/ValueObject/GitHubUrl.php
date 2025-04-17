<?php

namespace App\Contexts\GitHubApi\Domain\ValueObject;

use InvalidArgumentException;

readonly class GitHubUrl
{
    public function __construct(public string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('GitHub URL cannot be empty');
        }
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL format');
        }
        if (!str_starts_with($value, 'https://github.com/')) {
            throw new InvalidArgumentException('URL must be a GitHub URL');
        }
    }

    public function equals(GitHubUrl $other): bool
    {
        return $this->value === $other->value;
    }
}