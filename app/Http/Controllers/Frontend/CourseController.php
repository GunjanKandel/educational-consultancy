<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Country;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::where('is_active', true)->with('country');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by country
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        // Filter by fee range
        if ($request->filled('min_fee') && $request->filled('max_fee')) {
            $query->whereBetween('fee', [$request->min_fee, $request->max_fee]);
        }

        // Filter by duration
        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'fee_low':
                $query->orderBy('fee', 'asc');
                break;
            case 'fee_high':
                $query->orderBy('fee', 'desc');
                break;
            default:
                $query->latest();
        }

        $courses = $query->paginate(12)->withQueryString();

        $countries = Country::where('is_active', true)->get();

        return view('frontend.courses.index', compact('courses', 'countries'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->where('is_active', true)
            ->with('country')
            ->firstOrFail();

        // Get related courses
        $related_courses = Course::where('country_id', $course->country_id)
            ->where('id', '!=', $course->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('frontend.courses.show', compact('course', 'related_courses'));
    }
}
