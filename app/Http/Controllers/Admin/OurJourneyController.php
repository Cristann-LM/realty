<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurJourney;
use Illuminate\Http\Request;

class OurJourneyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|max:1000',
        ]);

        // Assuming you have a model called OurJourney
        OurJourney::create($validated);

        return redirect()
            ->route('admin.about-us.edit', 1)
            ->with('success', 'Journey created successfully!');
    }
    public function edit(OurJourney $journey)
    {
        return inertia('Admin/Pages/AboutUs/OurJourney/Edit', [
            'journey' => $journey::findOrFail($journey->id),
        ]);
    }

    public function update(Request $request, OurJourney $journey)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|max:1000',
        ]);

        // Update the journey with the validated data
        $journey->update($validated);

        return redirect()
            ->route('admin.journeys.edit', $journey->id)
            ->with('success', 'Journey updated successfully!');
    }

    public function destroy(OurJourney $journey)
    {
        $journey->deleteOrFail();

        return redirect()
            ->route('admin.about-us.edit', 1)
            ->with('success', 'Journey deleted successfully!');
    }
}
