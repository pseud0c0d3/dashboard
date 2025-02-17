<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content', 'user_id', 'comment_id'];  // Add 'content' here

    public function up()
{
    Schema::create('replies', function (Blueprint $table) {
        $table->id();
        $table->text('content');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('comment_id')->constrained()->onDelete('cascade'); // Link reply to comment
        $table->timestamps();
    });
}
public function comment()
{
    return $this->belongsTo(Comment::class);
}


}
