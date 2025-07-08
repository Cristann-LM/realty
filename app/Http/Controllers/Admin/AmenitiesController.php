<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Project;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function store(Amenity $amenity, Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|max:255',
        ]);

        $amenity::create($validated);

        return redirect()
            ->route('admin.project.show', $request->project_id)
            ->with('success', 'Amenity created successfully!');
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();

        return redirect()
            ->route('admin.project.show', $amenity->project->id)
            ->with('success', 'Amenity deleted successfully!');
    }
}
