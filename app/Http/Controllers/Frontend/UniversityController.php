<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Country;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::with('country')
            ->where('is_active', true);

        // Filter by country
        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        // Filter by partnership level
        if ($request->filled('partnership')) {
            $query->where('partnership_level', $request->partnership);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort by ranking
        if ($request->filled('sort')) {
            if ($request->sort == 'ranking_asc') {
                $query->orderBy('world_ranking', 'asc');
            } elseif ($request->sort == 'ranking_desc') {
                $query->orderBy('world_ranking', 'desc');
            }
        } else {
            $query->latest();
        }

        $universities = $query->paginate(12);
        $countries = Country::withCount(['universities' => function($q) {
            $q->where('is_active', true);
        }])->having('universities_count', '>', 0)->get();

        return view('frontend.universities.index', compact('universities', 'countries'));
    }

    public function show($slug)
    {
        $university = University::with('country', 'scholarships')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related universities from same country
        $relatedUniversities = University::with('country')
            ->where('country_id', $university->country_id)
            ->where('id', '!=', $university->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('frontend.universities.show', compact('university', 'relatedUniversities'));
    }
}
