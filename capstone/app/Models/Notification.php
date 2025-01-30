<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'type', 'message'];

    // You can add a relationship to the User model if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
