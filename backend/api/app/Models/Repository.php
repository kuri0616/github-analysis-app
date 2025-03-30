<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repository extends Model
{
    use HasFactory;

    protected $primaryKey = 'github_id';

    public $incrementing = false;

    protected $fillable = [
        'github_id',
        'name',
        'full_name',
        'description',
        'is_private',
        'owner_login',
        'owner_github_id',
        'html_url',
        'language',
        'forks_count',
        'stargazers_count',
        'watchers_count',
        'open_issues_count',
        'default_branch',
        'github_created_at',
        'github_updated_at',
        'github_pushed_at',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'forks_count' => 'integer',
        'stargazers_count' => 'integer',
        'watchers_count' => 'integer',
        'open_issues_count' => 'integer',
        'github_created_at' => 'datetime',
        'github_updated_at' => 'datetime',
        'github_pushed_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'owner_github_id', 'id');
    }

    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class, 'repository_id', 'github_id');
    }
}