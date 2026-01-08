<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('is_active', true)
            ->withCount('courses')
            ->paginate(12);

        return view('frontend.countries.index', compact('countries'));
    }

    public function show($slug)
    {
        $country = Country::where('slug', $slug)
            ->where('is_active', true)
            ->withCount('courses')
            ->firstOrFail();

        $courses = $country->courses()
            ->where('is_active', true)
            ->paginate(9);

        $universities = $country->universities()
            ->where('is_active', true)
            ->get();

        $scholarships = $country->scholarships()
            ->where('is_active', true)
            ->where('application_deadline', '>=', now())
            ->get();

        return view('frontend.countries.show', compact('country', 'courses', 'universities', 'scholarships'));
    }
}
