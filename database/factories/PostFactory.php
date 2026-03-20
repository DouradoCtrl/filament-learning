<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'thumbnail' => "https://placehold.co/640x480/png?text=Thumbnail",
            'is_published' => rand(0, 1),
            'content' => fake()->paragraphs(3, true),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
