<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        return inertia('Admin/Pages/Hero/Edit', [
            'hero' => Hero::firstOrFail(),
        ]);
    }

    public function update(Request $request, Hero $hero)
    {
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string|max:1000',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('hero_image')) {
            // Delete old image if exists
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            $path = $request->file('hero_image')->store('heroes', 'public');
            $validated['hero_image'] = $path;
        } else {
            unset($validated['hero_image']);
        }

        $hero->update($validated);

        return redirect()
            ->route('admin.heroes.edit', $hero->id)
            ->with('success', 'Hero details updated successfully!');
    }
}
