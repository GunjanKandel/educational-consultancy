<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; // Added this import
use App\Mail\ContactReplyMail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        if ($contact->status === 'pending') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,read,replied',
        ]);

        $contact->update($validated);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function reply(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $contact->update([
            'admin_reply' => $validated['admin_reply'],
            'status' => 'replied',
            'replied_at' => now(),
        ]);

        try {
            // Ensure the Mailable is receiving the $contact object correctly
            Mail::to($contact->email)->send(new ContactReplyMail($contact));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('warning', 'Reply saved, but email failed. Check your Mail settings.');
        }

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Reply sent successfully!');
    }

    public function destroy(Contact $contact)
    {
        // Consistent role check
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Only admins can delete contacts.');
        }

        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully!');
    }
}