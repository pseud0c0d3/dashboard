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
        'image',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}
public function likes()
{
    return $this->hasMany(Like::class);
}
public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subDays(15));
    }

}
