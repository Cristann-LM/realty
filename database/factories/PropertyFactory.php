<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
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
            'name' => $this->faker->unique()->word(),
            'type' => $this->faker->randomElement(['Townhouse', 'Rowhouse', 'Single Attached']), // Random type of property
            'price' => $this->faker->numberBetween(600000, 10000000), // Random price between 100,000 and 1,000,000
            'floor_area' => $this->faker->numberBetween(50, 150), // Random floor area between 50 and 500 square meters
            'lot_area' => $this->faker->numberBetween(50, 150), // Random lot area between 100 and 1000 square meters
            'bedrooms' => $this->faker->numberBetween(1, 5), // Random number of bedrooms between 1 and 5
            'bathrooms' => $this->faker->numberBetween(1, 3), // Random number of bathrooms between 1 and 3
            'parking_spaces' => $this->faker->numberBetween(0, 2), // Random number of parking spaces between 0 and 2
        ];
    }
}
