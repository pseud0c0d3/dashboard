<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Adding a password column
        

        // Adding a bio column (nullable)
        $table->text('bio')->nullable();

        // Adding a picture column (nullable)
        $table->string('picture')->nullable();

        // Adding a phone_number column (nullable)
        $table->string('phone_number')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Dropping the columns if rolled back
        
        $table->dropColumn('bio');
        $table->dropColumn('picture');
        $table->dropColumn('phone_number');
    });
}

};
