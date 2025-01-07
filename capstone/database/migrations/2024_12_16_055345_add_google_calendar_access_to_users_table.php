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
        Schema::table('users', function (Blueprint $table) {
            $table->string('calendar_access_token')->nullable();
            $table->string('calendar_refresh_token')->nullable();
            $table->string('calendar_user_account_info')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('calendar_access_token');
            $table->dropColumn('calendar_refresh_token');
            $table->dropColumn('calendar_user_account_info');
        });
    }
};
