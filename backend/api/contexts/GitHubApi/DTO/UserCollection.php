<?php

namespace App\Contexts\GitHubApi\DTO;
use Illuminate\Support\Collection;

class UserCollection
{
    /**
     * @var Collection<User>
     */
    private Collection $users;

    public function __construct(User ...$users)
    {
        $this->users = collect(...$users);
    }

    public function toArray(): array
    {
        return $this->users->toArray();
    }
}
