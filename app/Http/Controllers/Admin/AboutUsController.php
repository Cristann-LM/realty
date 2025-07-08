<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\OurJourney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function edit()
    {
        return inertia('Admin/Pages/AboutUs/Edit', [
            'aboutUs' => AboutUs::firstOrFail(),
            'journey' => OurJourney::orderBy('year', 'desc')->get(),
        ]);
    }

    public function update(Request $request, AboutUs $about_u)
{
    $validated = $request->validate([
        'image' => 'nullable|mimes:jpg,jpeg,png|image|max:2048',
        'description' => 'sometimes|required|max:1000',
        'mission' => 'sometimes|required|max:500',
        'vision' => 'sometimes|required|max:500',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($about_u->image && Storage::disk('public')->exists($about_u->image)) {
            Storage::disk('public')->delete($about_u->image);
        }
        $path = $request->file('image')->store('about_us', 'public');
        $validated['image'] = $path;
    } else {
        unset($validated['image']);
    }

    $about_u->update($validated);

    return redirect()
        ->route('admin.about-us.edit', 1)
        ->with('success', 'About Us details updated successfully!');
}
}
