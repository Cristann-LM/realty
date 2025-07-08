<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => $this->faker->numberBetween(1, Project::count()), // Assuming you have 10 projects
            'name' =>   $this->faker->randomElement(['Swimming Pool', 'Clubhouse', 'Gym', 'Playground', 'Basketball Court', '24/7 Security', 'Landscaped Gardens']), // Random amenity name
        ];
    }
}
