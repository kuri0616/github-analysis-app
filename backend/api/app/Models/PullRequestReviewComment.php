<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PullRequestReviewComment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'pull_request_id',
        'pull_request_review_id',
        'user_id',
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
        return $this->belongsTo(PullRequest::class, 'pull_request_id', 'id');
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(PullRequestReview::class, 'pull_request_review_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'user_id', 'id');
    }
}