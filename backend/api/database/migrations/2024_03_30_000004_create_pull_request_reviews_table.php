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
        Schema::create('pull_request_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('pull_request_id');        
            $table->unsignedBigInteger('user_id');
            $table->enum('state', ['APPROVED', 'CHANGES_REQUESTED', 'COMMENTED', 'DISMISSED', 'PENDING']);
            $table->text('body')->nullable();
            $table->timestamp('submitted_at');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('user_id')->references('id')->on('github_users');

            $table->foreign('pull_request_id')
            ->references('id')
            ->on('pull_requests')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pull_request_review_comments', function (Blueprint $table) {
            $table->dropForeign(['pull_request_review_id']);
        });
        
        Schema::dropIfExists('pull_request_reviews');
    }
}; 