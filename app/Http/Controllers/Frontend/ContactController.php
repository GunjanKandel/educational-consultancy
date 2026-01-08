<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotificationMail;

class ContactController extends Controller
{
    public function index()
    {
        $branches = Branch::where('is_active', true)->get();
        return view('frontend.contact', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Send notification to admin
        try {
            $adminEmail = \App\Models\Setting::get('site_email', 'admin@educational.com');
            Mail::to($adminEmail)->send(new ContactNotificationMail($contact));
        } catch (\Exception $e) {
            // Log the error but don't stop the process
        }

        return redirect()->back()
            ->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}