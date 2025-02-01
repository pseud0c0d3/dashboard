<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'admin_id', 'content'];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
{
    return $this->belongsTo(Admin::class);
}

// A comment can have many replies
public function replies()
{
    return $this->hasMany(Comment::class, 'parent_comment_id');
}

// A comment belongs to a parent comment (if it's a reply)
public function parentComment()
{
    return $this->belongsTo(Comment::class, 'parent_comment_id');
}
}
