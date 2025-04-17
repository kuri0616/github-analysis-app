<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repository extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'is_private',
        'user_id',
        'html_url',
        'created_at',
        'updated_at',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(GitHubUser::class, 'user_id', 'id');
    }

    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class, 'repository_id', 'id');
    }
}