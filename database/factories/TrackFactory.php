<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
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
            "path" => fake()->randomElement([
                "test/Cinderella.mp3",
                "test/GODS_COUNTRY.mp3",
                "test/Like_That.mp3",
                "test/Magic_Don_Juan.mp3",
                "test/MODERN_JAM.mp3",
                "test/Runnin_Outta_Time.mp3",
                "test/SIRENS.mp3",
                "test/THANK_GOD.mp3",
                "test/Type_Shit.mp3",
                "test/We_Dont_Trust_You.mp3"
            ]),
            "views" => 0,
            "album_id" => fake()->numberBetween(1, 2)
        ];
    }
}
