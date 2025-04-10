<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    // Table name (optional, Laravel uses the pluralized model name by default)
    protected $table = 'admins';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'username',
        'picture',
        'phone_number',
        'status',
    ];

    // Hidden attributes (e.g., password and remember_token) for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes to specific types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Disable timestamps if not used
    public $timestamps = false;
}
