<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image',
        'admin_id', // Add this
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // Define the admin relationship
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

public function isLikedBy(User $user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}

    public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subDays(15));
    }
}
