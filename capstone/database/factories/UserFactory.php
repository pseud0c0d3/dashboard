<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Default password (you can change it)
            'bio' => $this->faker->paragraph(),
            'phone_number' => $this->faker->phoneNumber(),
            'username' => $this->faker->unique()->userName(),
            'status' => $this->faker->boolean(80), // 80% chance of being active
        ];
    }
}
