<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyImage>
 */
class PropertyImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => $this->faker->numberBetween(1, \App\Models\Property::count()), // Assuming you have properties created
            'image_path' => $this->faker->imageUrl(640, 480, 'property', true, 'Faker'), // Generates a random image URL
        ];
    }
}
