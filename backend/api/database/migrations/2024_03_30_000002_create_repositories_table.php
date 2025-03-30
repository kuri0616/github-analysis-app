<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->unsignedBigInteger('github_id')->primary();
            $table->string('name');
            $table->string('full_name')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_private')->default(false);
            $table->string('owner_login')->nullable();
            $table->unsignedBigInteger('owner_github_id');
            $table->string('html_url');
            $table->string('language')->nullable();
            $table->integer('forks_count')->default(0);
            $table->integer('stargazers_count')->default(0);
            $table->integer('watchers_count')->default(0);
            $table->integer('open_issues_count')->default(0);
            $table->string('default_branch');
            $table->timestamp('github_created_at')->nullable();
            $table->timestamp('github_updated_at')->nullable();
            $table->timestamp('github_pushed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('owner_github_id')->references('id')->on('github_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
}; 