<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->word(),
            "singer_id" => fake()->numberBetween(1, 2),
            "img" => fake()->randomElement([
                "test_img/123.jpg",
                "test_img/jaD1Lz7Hbwg.jpg",
                "test_img/YEYM6fKu.jpeg"
            ]),
            "date" => now(),
        ];
    }
}
