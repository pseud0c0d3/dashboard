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
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable()->after('user_id'); // Correct column name
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

            $table->string('image')->nullable(); // Adding image column

            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            // Remove 'parent_comment_id' if not needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');

            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');

            $table->dropColumn('image'); // Drop image column as well
        });
    }
};
