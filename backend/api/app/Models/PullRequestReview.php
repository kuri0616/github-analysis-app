<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PullRequestReview extends Model
{
    use HasFactory;

    protected $primaryKey = 'github_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'github_id',
        'pull_request_id',
        'user_github_id',
        'user_login',
        'state',
        'body',
        'submitted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pullRequest(): BelongsTo
    {
        return $this->belongsTo(PullRequest::class, 'pull_request_id', 'github_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'user_github_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PullRequestReviewComment::class, 'pull_request_review_id', 'github_id');
    }

}