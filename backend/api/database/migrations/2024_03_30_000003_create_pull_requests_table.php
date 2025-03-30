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
        Schema::create('pull_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('github_id')->primary();
            $table->unsignedBigInteger('repository_id');
            $table->integer('number')->unsigned();
            $table->string('title');
            $table->enum('state', ['open', 'closed']);
            $table->boolean('locked')->default(false);
            $table->unsignedBigInteger('author_github_id')->nullable();
            $table->string('author_login')->nullable();
            $table->text('body')->nullable();
            $table->string('html_url');
            $table->integer('comments_count')->default(0);
            $table->integer('review_comments_count')->default(0);
            $table->integer('commits_count')->default(0);
            $table->integer('additions_count')->default(0);
            $table->integer('deletions_count')->default(0);
            $table->integer('changed_files_count')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('merged_at')->nullable();
            
            $table->foreign('repository_id')
                  ->references('github_id')
                  ->on('repositories')
                  ->onDelete('cascade');
            
            $table->unique(['repository_id', 'number']);
            
            $table->foreign('author_github_id')
                  ->references('id')
                  ->on('github_users')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pull_requests');
    }
}; 