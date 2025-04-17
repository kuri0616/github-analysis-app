<?php

namespace App\Contexts\GitHubApi\Domain\ValueObject;

use DateTime;
use InvalidArgumentException;

readonly class GitHubTimestamp
{
    public function __construct(public string $value)
    {
        $timestamp = DateTime::createFromFormat(DateTime::ISO8601, $value);
        if ($timestamp === false) {
            throw new InvalidArgumentException('Invalid GitHub timestamp format. Must be ISO8601');
        }
        $this->value = $timestamp;
    }

    public function getFormattedValue(): string
    {
        return $this->value->format(DateTime::ISO8601);
    }

    public function getDifferenceInHours(GitHubTimestamp $other): float
    {
        $diff = $this->value->diff($other->value);
        return ($diff->days * 24) + $diff->h + ($diff->i / 60);
    }
}