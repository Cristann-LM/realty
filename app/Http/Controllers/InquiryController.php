<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Notifications\InquiryNotification;
use App\Notifications\InquiryReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InquiryController extends Controller
{
    public function store(Request $request, Inquiry $inquiry)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    $createdInquiry = $inquiry->create($validated);

    // Send notification to the user who submitted the inquiry
    Notification::route('mail', $validated['email'])
        ->notify(new InquiryReceived((object)$validated));

    Notification::route('mail', 'llydmndz113@gmail.com')
        ->notify(new InquiryNotification((object)$validated));

    return redirect()
        ->route('contact-us.index')
        ->with('success', 'Inquiry submitted successfully!');
}
}
