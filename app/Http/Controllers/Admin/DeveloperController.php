<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Properties/Developer/Index', [
            'developer' => Developer::mostRecent()
            ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
    ]);

    Developer::create($validated);

       return redirect()
        ->route('admin.developer.index')
        ->with('success', 'Developer created successfully!');

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
    public function edit(Developer $developer)
    {
        return inertia('Admin/Properties/Developer/Edit', [
            'developer' => $developer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, Developer $developer)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $developer->update($validated);

       return redirect()
        ->route('admin.developer.index')
        ->with('success', 'Developer updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        $developer->deleteOrFail();

         return redirect()
        ->route('admin.developer.index')
        ->with('success', 'Developer deleted successfully!');

    }

}
