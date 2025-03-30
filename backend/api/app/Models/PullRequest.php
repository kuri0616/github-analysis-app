<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PullRequest extends Model
{
    use HasFactory;

    protected $primaryKey = 'github_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'github_id',
        'repository_id',
        'number',
        'title',
        'state',
        'locked',
        'author_github_id',
        'author_login',
        'body',
        'html_url',
        'comments_count',
        'review_comments_count',
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
        'locked' => 'boolean',
        'number' => 'integer',
        'comments_count' => 'integer',
        'review_comments_count' => 'integer',
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
        return $this->belongsTo(Repository::class, 'repository_id', 'github_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'author_github_id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PullRequestReview::class, 'pull_request_id', 'github_id');
    }

    public function reviewComments(): HasMany
    {
        return $this->hasMany(PullRequestReviewComment::class, 'pull_request_id', 'github_id');
    }

    public function isMerged(): bool
    {
        return $this->merged_at !== null;
    }

    public function getDurationInHours(): ?float
    {
        if ($this->merged_at === null && $this->closed_at === null) {
            return null;
        }

        $endDate = $this->merged_at ?? $this->closed_at;
        $start = new \DateTime($this->created_at);
        $end = new \DateTime($endDate);
        $diff = $end->diff($start);

        return ($diff->days * 24) + $diff->h + ($diff->i / 60);
    }
}