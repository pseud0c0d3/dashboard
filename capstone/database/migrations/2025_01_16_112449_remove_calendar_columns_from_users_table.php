<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCalendarColumnsFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['calendar_access_token', 'calendar_refresh_token', 'calendar_user_account_info']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('calendar_access_token')->nullable();
            $table->string('calendar_refresh_token')->nullable();
            $table->text('calendar_user_account_info')->nullable();
        });
    }
}

