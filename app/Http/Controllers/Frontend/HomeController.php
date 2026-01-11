<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Blog;
use App\Models\User;
use App\Models\Country;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\Branch;
use App\Models\University;

class HomeController extends Controller
{
    public function index()
    { 
        // Featured Courses (limit to 6 for better display)
        $featured_courses = Course::where('is_featured', true)
            ->with('country')
            ->take(6)
            ->get();

        // Latest Blogs
        $latest_blogs = Blog::where('is_published', true)
            ->latest()
            ->take(5)
            ->get();

        // Stats - Enhanced with partner universities
        $stats = [
            'total_students' => 5000, // You can use User::where('role', 'student')->count() if you have student role
            'total_countries' => Country::count(),
            'success_rate' => 98, // You can calculate dynamically based on successful applications
            'partner_universities' => University::count() ?? 150, // Use actual count if universities table exists
        ];

        // Popular countries (increased to 12 for responsive grid)
        $popular_countries = Country::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->take(12)
            ->get();

        // Services (limit to 6 for better display)
        $services = Service::take(6)->get();

        // Team Members (show top 4 for homepage)
        $teams = Team::where('is_active', true)
            ->orderBy('order', 'asc')
            ->take(4)
            ->get();

        // Branches (show top 3 for homepage)
        $branches = Branch::where('is_active', true)
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        // Testimonials (featured ones only, limit to 3 for better mobile display)
        $testimonials = Testimonial::with('country')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home', compact(
            'featured_courses',
            'latest_blogs',
            'stats',
            'popular_countries',
            'services',
            'teams',
            'branches',
            'testimonials'
        ));
    }

    public function about()
    {
        // Load team members for about page
        $teams = Team::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('frontend.about', compact('teams'));
    }

    public function services()
    {
        // Load all services for services page
        $services = Service::all();

        return view('frontend.services', compact('services'));
    }

    public function team()
    {
        // Load all team members for team page
        $teams = Team::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('frontend.team', compact('teams'));
    }
}