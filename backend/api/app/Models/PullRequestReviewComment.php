<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PullRequestReviewComment extends Model
{
    use HasFactory;

    protected $primaryKey = 'github_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'github_id',
        'pull_request_id',
        'pull_request_review_id',
        'user_github_id',
        'user_login',
        'body',
        'html_url',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pullRequest(): BelongsTo
    {
        return $this->belongsTo(PullRequest::class, 'pull_request_id', 'github_id');
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(PullRequestReview::class, 'pull_request_review_id', 'github_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'user_github_id', 'id');
    }
}