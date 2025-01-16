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
        // Shared Accounts Table
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role'); // 'admin' or 'user'
            $table->timestamps();
        });

        // Admins Table
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->unique(); // Foreign key to accounts
            $table->string('employee_id')->unique();
            $table->string('name');
            $table->string('level'); // Example: supervisor, manager
            $table->json('permissions'); // Flexible JSON field
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });

        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->unique(); // Foreign key to accounts
            $table->string('user_id')->unique();
            $table->string('profile_picture')->nullable();
            $table->json('preferences')->nullable(); // Flexible JSON field
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });

        // Password Reset Tokens Table (unchanged)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions Table (unchanged)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('accounts');
    }
};
