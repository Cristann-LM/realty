<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = Project::query()
        ->select('city')
        ->distinct()
        ->orderBy('city')
        ->pluck('city')
        ->filter()
        ->values();

        return inertia('Index/Welcome', [
            'properties' => \App\Models\Property::mostRecent()
                ->with('project.amenities')
                ->with('propertyImages')
                ->take(6)
                ->get(),
            'teamMembers' => \App\Models\OurTeam::all(),
            'about' => \App\Models\AboutUs::firstOrFail(),
            'journey' => \App\Models\OurJourney::all(),
            'cities' => $cities,
            'hero' => \App\Models\Hero::firstOrFail(),

        ]);
    }
}
