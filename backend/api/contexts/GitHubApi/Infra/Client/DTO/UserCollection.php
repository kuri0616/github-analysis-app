<?php

namespace App\Contexts\GitHubApi\Infra\Client\DTO;

use App\Contexts\GitHubApi\Infra\Client\DTO\User;
use Illuminate\Support\Collection;

class UserCollection
{
    /**
     * @var Collection<User>
     */
    private Collection $users;

    public function __construct(User ...$users)
    {
        $this->users = collect($users);
    }

    public function toArray(): array
    {
        return $this->users->map(fn(User $user) => $user->toArray())->toArray();
    }
}
