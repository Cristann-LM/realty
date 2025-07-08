<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\Amenity;
use App\Models\ContactUs;
use App\Models\Developer;
use App\Models\OurJourney;
use App\Models\OurTeam;
use App\Models\Project;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Developer::factory(3)->create();
        Project::factory(5)->create();
        Amenity::factory(20)->create();
        Property::factory(20)->create();
        PropertyImage::factory(50)->create();
        OurTeam::factory(10)->create();
        AboutUs::factory()->create();
        ContactUs::factory()->create();
        OurJourney::factory(3)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
