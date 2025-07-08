<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
{
    $filters = $request->only(['propertyType', 'location', 'price_min', 'price_max']);

    // Get all unique cities from projects table
    $cities = Project::query()
        ->select('city')
        ->distinct()
        ->orderBy('city')
        ->pluck('city')
        ->filter()
        ->values();

    return inertia('Properties/Index', [
        'filters' => $filters,
        'properties' => Property::mostRecent()
            ->with('project.amenities')
            ->with('propertyImages')
            ->filter($filters)
            ->paginate(9)
            ->withQueryString(),
        'cities' => $cities,
    ]);
}

    public function show(Property $property)
    {
        return inertia('Properties/Show', [
            'property' => $property->load(['project.amenities', 'propertyImages']),
        ]);
    }
}
