<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Notifications\InquiryReply;
use Illuminate\Support\Facades\Notification;

class InquiryController extends Controller
{
    public function index()
    {
        return inertia ('Admin/Inquiry/Index', [
            'inquiries' => Inquiry::orderByDesc('read_at')->get(),
        ]);
    }

    public function edit(Inquiry $inquiry)
    {
        return inertia('Admin/Inquiry/Edit', [
            'inquiry' => $inquiry,
        ]);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'reply' => 'required|max:1000',
        ]);

        $inquiry->update($validated);

        Notification::route('mail', $inquiry->email)
            ->notify(new InquiryReply($inquiry, $validated['reply']));

        return redirect()
            ->back()
            ->with('success', 'Reply sent successfully!');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()
            ->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully!');
    }

    public function markAsRead(Inquiry $inquiry)
    {
        if ($inquiry->read_at) {
            $inquiry->read_at = null; // Mark as unread
        } else {
            $inquiry->read_at = now(); // Mark as read
        }
        $inquiry->save();
        return redirect()->back()->with('success', 'Inquiry marked as read/unread.');
    }
}
