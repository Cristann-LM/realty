<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Properties/Unit/Index', [
            'properties' => Property::mostRecent()
            ->with('project.amenities')
            ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Properties/Unit/Create', [
               'projects' => Project::all()
               ->load(['developer', 'amenities']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required',
            'type' => 'required',
            'price' => 'required|numeric|min:0',
            'floor_area' => 'required|numeric|min:0',
            'lot_area' => 'nullable|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'parking_spaces' => 'nullable|integer|min:0',
        ]);

        Property::create($validated);

        return redirect()->route('admin.property-units.index')->with('success', 'Property unit created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::with('project.amenities')->findOrFail($id);

        $images = $property->propertyImages->sortByDesc('is_primary')->values();

        return inertia('Admin/Properties/Unit/Show', [
            'property' => $property,
            'images' => $images,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property_unit)
    {
        return inertia('Admin/Properties/Unit/Edit', [
            'property' => $property_unit,
            'projects' => Project::all()->load(['developer', 'amenities']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property_unit)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required',
            'type' => 'required',
            'price' => 'required|numeric|min:0',
            'floor_area' => 'required|numeric|min:0',
            'lot_area' => 'nullable|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'parking_spaces' => 'nullable|integer|min:0',
        ]);

        $property_unit->update($validated);

        return redirect()->route('admin.property-units.index')->with('success', 'Property unit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property_unit)
    {
        $property_unit->delete();

        return redirect()->route('admin.property-units.index')->with('success', 'Property unit deleted successfully!');
    }
}
