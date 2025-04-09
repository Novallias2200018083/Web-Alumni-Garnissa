<?php

namespace Database\Factories;
use App\Models\Event;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(),
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+6 months'),
            'image' => 'events/default.jpg',

        ];
    }
}
