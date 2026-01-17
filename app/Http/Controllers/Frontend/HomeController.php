<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutTopic;
use App\Models\Course;
use App\Models\Blog;
use App\Models\User;
use App\Models\Country;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\Branch;
use App\Models\Event;
use App\Models\Faq;
use App\Models\University;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    { 
        // Featured Courses (limit to 6 for homepage)
        $featured_courses = Course::where('is_featured', true)
            ->with('country')
            ->take(6)
            ->get();

        // Latest Blogs (limit to 5)
        $latest_blogs = Blog::where('is_published', true)
            ->latest()
            ->take(5)
            ->get();

        // Stats
        $stats = [
            'total_students' => 5000, // Replace with actual student count if needed
            'total_countries' => Country::count(),
            'success_rate' => 98, // Replace with dynamic calculation if needed
            'partner_universities' => University::count() ?? 150,
        ];

        // Popular Countries (limit 12)
        $popular_countries = Country::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->take(12)
            ->get();

        // Services (limit 6)
        $services = Service::take(6)->get();

        // Team Members (top 4 for homepage)
        $teams = Team::where('is_active', true)
            ->orderBy('display_order', 'asc') // Correct column
            ->take(4)
            ->get();

        // Branches (top 3 for homepage)
        $branches = Branch::where('is_active', true)
            ->orderBy('order', 'asc') // Correct column
            ->take(3)
            ->get();

        // Testimonials (top 3 featured)
        $testimonials = Testimonial::with('country')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        // About Topics (ordered)
        $aboutTopics = AboutTopic::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('frontend.home', compact(
            'featured_courses',
            'latest_blogs',
            'stats',
            'popular_countries',
            'services',
            'teams',
            'branches',
            'testimonials',
            'aboutTopics'
        ));
    }

    public function about()
    {
        $teams = Team::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();

        $aboutTopics = AboutTopic::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('frontend.about', compact('teams', 'aboutTopics'));
    }

    public function services()
    {
        $services = Service::all();
        return view('frontend.services', compact('services'));
    }

    public function team()
    {
        $teams = Team::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->paginate(9);

        return view('frontend.team', compact('teams'));
    }

    public function events()
    {
        $today = Carbon::now();

        $upcoming_events = Event::where('is_active', true)
            ->where('event_date', '>=', $today)
            ->orderBy('event_date', 'asc')
            ->get();

        $past_events = Event::where('is_active', true)
            ->where('event_date', '<', $today)
            ->orderBy('event_date', 'desc')
            ->get();

        return view('frontend.events', compact('upcoming_events', 'past_events'));
    }

    public function scholarships()
    {
        $scholarships = \App\Models\Scholarship::where('is_active', true)
            ->latest()
            ->paginate(9);

        return view('frontend.scholarships', compact('scholarships'));
    }

    public function faqs()
    {
        $faqs = Faq::where('is_active', 1)
            ->orderBy('category')
            ->orderBy('id')
            ->get()
            ->groupBy('category');

        return view('frontend.faqs', compact('faqs'));
    }
}
