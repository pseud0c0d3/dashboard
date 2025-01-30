<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type', 'message', 'user_id', 'post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, you can add a method to retrieve the post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
