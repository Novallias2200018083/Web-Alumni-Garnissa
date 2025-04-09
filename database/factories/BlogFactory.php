<?php

namespace Database\Factories;
use App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(800, 400, 'business', true, 'Blog'),
            'title' => $this->faker->sentence(6),
            'published_at' => $this->faker->date(),
            'description' => $this->faker->paragraphs(3, true),
        ];
    }
}
