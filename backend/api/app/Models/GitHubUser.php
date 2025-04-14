<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GitHubUser extends Model
{
    use HasFactory;

    protected $table = 'github_users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'avatar_url',
        'html_url',
    ];

    public function repositories(): HasMany
    {
        return $this->hasMany(Repository::class, 'user_id', 'id');
    }

    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class, 'user_id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PullRequestReview::class, 'user_id', 'id');
    }

    public function reviewComments(): HasMany
    {
        return $this->hasMany(PullRequestReviewComment::class, 'user_id', 'id');
    }
}