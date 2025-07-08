<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutUs>
 */
class AboutUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->paragraph(15),
            'mission' => fake()->paragraph(5),
            'vision' => fake()->paragraph(5),
            'image' => fake()->imageUrl(640, 480, 'business', true, 'About Us Image'),
        ];
    }
}
