<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    

    protected $fillable = [
        'title', 'description', 'start_time', 'end_time', 'is_public', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
