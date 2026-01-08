<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Blog;
use App\Models\User;
use App\Models\Country;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    { 
        // Featured Courses
        $featured_courses = Course::where('is_featured', true)->take(5)->get();

        // Latest Blogs
        $latest_blogs = Blog::where('is_published', true)->latest()->take(5)->get();

        // Stats
        $stats = [
            'total_students' => User::count(),
            'total_countries' => Country::count(),
            'success_rate' => 95, // You can calculate dynamically if needed
            'partner_universities' => 25, // Replace with actual count if you have a universities table
        ];

        // Popular countries (you can customize the query)
        $popular_countries = Country::withCount('courses')->orderBy('courses_count', 'desc')->take(6)->get();

        // Services
        $services = Service::all();

        // Testimonials
        $testimonials = Testimonial::with('country')->latest()->take(6)->get();

        return view('frontend.home', compact(
            'featured_courses',
            'latest_blogs',
            'stats',
            'popular_countries',
            'services',
            'testimonials'
        ));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        return view('frontend.services');
    }
}
