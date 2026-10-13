<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\MovieStatus;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'director' => fake()->name(),
            'rating' => fake()->numberBetween(0, 10),
            'movie_status' => fake()->randomElement(array_column(MovieStatus::cases(), 'value')),
        ];
    }
}
