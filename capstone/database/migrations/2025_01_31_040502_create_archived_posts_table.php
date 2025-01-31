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
    Schema::create('archived_posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('body');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('admin_id')->nullable()->constrained()->onDelete('cascade');
        $table->timestamps();
        // You can add additional columns for "archived_at" to track when a post was archived
    });
}

public function down()
{
    Schema::dropIfExists('archived_posts');
}

};
