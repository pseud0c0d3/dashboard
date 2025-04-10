<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // You can adjust the number of users to create
        User::factory(15)->create(); // Create 50 users
    }
}
