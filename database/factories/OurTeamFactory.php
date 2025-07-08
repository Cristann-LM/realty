<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OurTeam>
 */
class OurTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'job_title' => $this->faker->jobTitle(),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'job_description' => $this->faker->paragraph(),
        ];
    }
}
