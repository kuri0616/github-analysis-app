<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PullRequest extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'repository_id',
        'pull_request_number',
        'title',
        'state',
        'user_id',
        'body',
        'html_url',
        'commits_count',
        'additions_count',
        'deletions_count',
        'changed_files_count',
        'created_at',
        'updated_at',
        'closed_at',
        'merged_at',
    ];

    protected $casts = [
        'pull_request_number' => 'integer',
        'commits_count' => 'integer',
        'additions_count' => 'integer',
        'deletions_count' => 'integer',
        'changed_files_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'closed_at' => 'datetime',
        'merged_at' => 'datetime',
    ];


    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class, 'repository_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'user_id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PullRequestReview::class, 'pull_request_id', 'id');
    }

    public function reviewComments(): HasMany
    {
        return $this->hasMany(PullRequestReviewComment::class, 'pull_request_id', 'id');
    }

}