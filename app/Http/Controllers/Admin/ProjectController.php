<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Properties/Project/Index', [
            'project' => Project::mostRecent()
            ->with('developer')
            ->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Properties/Project/Create', [
            'developer' => Developer::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Project $project)
    {
        $validated = $request->validate([
            'developer_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'address' => 'required|max:500',
            'city' => 'required|max:100',
            'province' => 'required|max:100',
            'google_map_link' => 'nullable',
        ]);

        $project->create($validated);

        return redirect()
            ->route('admin.project.index',  )
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return inertia('Admin/Properties/Project/Show', [
            'project' => $project->load('developer'),
            'amenities' => $project->amenities,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return inertia('Admin/Properties/Project/Edit', [
            'project' => $project,
            'developer' => Developer::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'developer_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'address' => 'required|max:500',
            'city' => 'required|max:100',
            'province' => 'required|max:100',
            'google_map_link' => 'required',
        ]);

        $project->update($validated);

        return redirect()
            ->route('admin.project.show', $project->id)
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.project.index')
            ->with('success', 'Project deleted successfully!');
    }
}
