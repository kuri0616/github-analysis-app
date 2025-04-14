<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PullRequestReview extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'pull_request_id',        
        'user_id',
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
        return $this->belongsTo(PullRequest::class, 'pull_request_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'user_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PullRequestReviewComment::class, 'pull_request_review_id', 'id');
    }

}