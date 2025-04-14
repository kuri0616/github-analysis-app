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
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('repository_id');
            $table->integer('pull_request_number')->unsigned();
            $table->string('title');
            $table->enum('state', ['open', 'closed']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('body')->nullable();
            $table->string('html_url');
            $table->integer('commits_count')->default(0);
            $table->integer('additions_count')->default(0);
            $table->integer('deletions_count')->default(0);
            $table->integer('changed_files_count')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('merged_at')->nullable();
            
            $table->foreign('repository_id')
                  ->references('id')
                  ->on('repositories')
                  ->onDelete('cascade');
            
            $table->unique(['repository_id', 'pull_request_number']);
            
            $table->foreign('user_id')
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