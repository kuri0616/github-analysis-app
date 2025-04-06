<?php

namespace App\Contexts\GitHubApi\DTO;
use Illuminate\Support\Collection;

class UserCollection
{
    private Collection $users;

    public function __construct(array $users)
    {
        $this->users = collect($users);
    }

    public function toArray(): array
    {
        return $this->users->toArray();
    }
}
