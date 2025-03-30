<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GitHubUser extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'login',
        'avatar_url',
        'html_url',
        'name',
        'email',
        'bio',
    ];

    public function repositories(): HasMany
    {
        return $this->hasMany(Repository::class, 'owner_github_id', 'id');
    }

    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class, 'author_github_id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PullRequestReview::class, 'user_github_id', 'id');
    }

    public function reviewComments(): HasMany
    {
        return $this->hasMany(PullRequestReviewComment::class, 'user_github_id', 'id');
    }
}