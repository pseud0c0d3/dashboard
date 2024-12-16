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
        Schema::create( 'calendar', function (Blueprint $table){
            $table->id();
            $table->string('email');
            $table->string('start');
            $table->string('end');
            $table->string('status')
            ->default(value:0)
            ->nullable();
            $table->string('is_all_day')
            ->default(value:0)
            ->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
