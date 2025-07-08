<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UnitImageController extends Controller
{
    public function store(Property $property_unit, Request $request)
    {
       if($request->hasFile('images')) {

            $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'images.*.image' => 'Each file must be an image.',
                'images.*.mimes' => 'Only jpeg, png, jpg, gif, and svg files are allowed.',
                'images.*.max' => 'Each image must not exceed 2MB.',
            ]
        );
            $images = $request->file('images');
            foreach ($images as $image) {
                $path = $image->store('property_units', 'public');
                $property_unit->propertyImages()->save(new PropertyImage([
                    'image_path' => $path,
                ]));
            }
        }

        return redirect()
            ->route('admin.property-units.show', ['property_unit' => $property_unit->id])
            ->with('success', 'Images uploaded successfully!');
    }
    public function destroy(Property $property_unit, PropertyImage $image)
    {
        if ($image->property_id !== $property_unit->id) {
            return redirect()->back()->with('error', 'Image does not belong to this property unit.');
        }

        // Delete the image file from storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Delete the image record from the database
        $image->delete();

        return redirect()
            ->back()
            ->with('success', 'Image deleted successfully!');
    }
    public function setPrimary(Property $property_unit, PropertyImage $image)
{
    // Ensure the image belongs to the property unit
    if ($image->property_id !== $property_unit->id) {
        return back()->withErrors(['images' => 'Image does not belong to this property unit.']);
    }

    // Unset previous primary
    $property_unit->propertyImages()->update(['is_primary' => false]);
    // Set new primary
    $image->is_primary = true;
    $image->save();

    return back()->with('success', 'Primary image updated!');
}
}
