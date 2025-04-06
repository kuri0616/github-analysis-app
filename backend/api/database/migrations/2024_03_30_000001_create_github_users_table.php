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
        Schema::create('github_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('login', 100)->unique();
            $table->string('avatar_url')->nullable();
            $table->string('html_url')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('github_users');
    }
};
