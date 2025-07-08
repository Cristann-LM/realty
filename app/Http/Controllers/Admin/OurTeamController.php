<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Pages/OurTeam/Index', [
            'teamMembers' => \App\Models\OurTeam::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Pages/OurTeam/Create', [
            'teamMembers' => OurTeam::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, OurTeam $our_team)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'job_title' => 'required|string|min:2|max:100',
            'job_description' => 'required|string|min:5|max:500',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048', // Adjust the validation rules as needed
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('team_members', 'public');
        } else {
            unset($validatedData['image']);
        }

        $our_team->create($validatedData);

        return redirect()->route('admin.our-team.index')->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OurTeam $our_team)
    {
        return inertia('Admin/Pages/OurTeam/Edit', [
            'teamMember' => $our_team,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OurTeam $our_team)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'job_title' => 'required|string|min:2|max:100',
            'job_description' => 'required|string|min:5|max:500',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048', // Adjust the validation rules as needed
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($our_team->image && Storage::disk('public')->exists($our_team->image)) {
                Storage::disk('public')->delete($our_team->image);
            }
            $validatedData['image'] = $request->file('image')->store('team_members', 'public');
        } else {
            unset($validatedData['image']);
        }

        $our_team->update($validatedData);

        return redirect()
        ->back()
        ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OurTeam $our_team)
    {
        $our_team->delete();
        // Optionally, you can also delete the image file if it exists
        if ($our_team->image) {
            Storage::disk('public')->delete($our_team->image);
        }
        return redirect()->route('admin.our-team.index')->with('success', 'Team member deleted successfully.');
    }
}
