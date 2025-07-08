<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function edit(ContactUs $contact_u){
        return inertia('Admin/Pages/ContactUs/Edit', [
            'contactUs' => $contact_u::firstOrFail(),
        ]);
    }

    public function update(Request $request, ContactUs $contact_u)
    {
        $validated = $request->validate([
            'address' => 'required|max:555',
            'email' => 'required|max:555',
            'phone' => 'required|max:555',
            'facebook' => 'nullable|max:555',
            'twitter' => 'nullable|max:555',
            'instagram' => 'nullable|max:555',
            'youtube' => 'nullable|max:555',
            'tiktok' => 'nullable|max:555',
            'google_map' => 'required|max:555',

        ]);

        $contact_u->update($validated);

        return redirect()
        ->route('admin.contact-us.edit', 1)
        ->with('success', 'Contact us updated successfully!');
    }
}
