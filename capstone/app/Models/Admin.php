<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Optional if your table name matches the default convention

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // You can add any custom methods or properties here
}

