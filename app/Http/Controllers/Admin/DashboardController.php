<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Country;
use App\Models\Application;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_courses' => Course::count(),
            'total_countries' => Country::count(),
            'total_applications' => Application::count(),
            'pending_applications' => Application::where('status', 'pending')->count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('status', 'pending')->count(),
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::where('is_published', true)->count(),
            'total_testimonials' => Testimonial::count(),
        ];

        $recent_applications = Application::with(['course', 'country'])
            ->latest()
            ->take(5)
            ->get();

        $recent_contacts = Contact::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_applications', 'recent_contacts'));
    }
}

