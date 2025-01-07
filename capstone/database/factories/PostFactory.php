<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(), // Generates a random title
            'body' => $this->faker->paragraphs(3, true), // Generates a random body
            'image' => $this->faker->imageUrl(640, 480, 'posts', true), // Generates a random image URL
        ];
    }
}
