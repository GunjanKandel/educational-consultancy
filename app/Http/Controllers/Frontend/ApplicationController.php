<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Course;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceivedMail;

class ApplicationController extends Controller
{
    public function create()
    {
        $courses = Course::where('is_active', true)
            ->with('country')
            ->orderBy('name')
            ->get();

        $countries = Country::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('frontend.application.create', compact('courses', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'nationality' => 'required|string|max:100',
            'passport_number' => 'required|string|max:50',
            'highest_qualification' => 'required|string|max:255',
            'gpa_percentage' => 'required|numeric|min:0|max:100',
            'english_test' => 'required|in:IELTS,TOEFL,PTE,Duolingo,None',
            'english_score' => 'nullable|numeric|min:0',
        ]);

        // Generate unique application number
        $validated['application_number'] = 'APP-' . strtoupper(Str::random(8));

        // Get country_id from course
        $course = Course::findOrFail($request->course_id);
        $validated['country_id'] = $course->country_id;

        $application = Application::create($validated);

        // Send confirmation email
        try {
            Mail::to($validated['email'])->send(new ApplicationReceivedMail($application));
        } catch (\Exception $e) {
            // Log the error but don't stop the process
        }

        return redirect()->route('application.success')
            ->with('application_number', $application->application_number)
            ->with('success', 'Your application has been submitted successfully!');
    }

    public function success()
    {
        if (!session()->has('application_number')) {
            return redirect()->route('home');
        }

        $application_number = session('application_number');
        
        return view('frontend.application.success', compact('application_number'));
    }
}