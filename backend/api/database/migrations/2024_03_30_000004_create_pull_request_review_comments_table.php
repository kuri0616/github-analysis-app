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
        Schema::create('pull_request_review_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('github_id')->primary();
            $table->unsignedBigInteger('pull_request_id');
            $table->foreign('pull_request_id')
                  ->references('github_id')
                  ->on('pull_requests')
                  ->onDelete('cascade');
                  
            $table->unsignedBigInteger('pull_request_review_id')->nullable();
            
            $table->unsignedBigInteger('user_github_id');
            $table->string('user_login')->nullable();
            $table->text('body');
            $table->string('html_url')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            
            // 外部キー制約
            $table->foreign('user_github_id')->references('id')->on('github_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pull_request_review_comments');
    }
}; 