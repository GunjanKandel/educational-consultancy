<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::with(['country', 'university'])
            ->latest()
            ->paginate(10);
        
        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        $countries = Country::where('is_active', true)->get();
        $universities = University::where('is_active', true)->get();
        return view('admin.scholarships.create', compact('countries', 'universities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'university_id' => 'nullable|exists:universities,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'eligibility_criteria' => 'required|string',
            'application_deadline' => 'required|date',
            'required_documents' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Scholarship::create($validated);

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Scholarship added successfully!');
    }

    public function edit(Scholarship $scholarship)
    {
        $countries = Country::where('is_active', true)->get();
        $universities = University::where('is_active', true)->get();
        return view('admin.scholarships.edit', compact('scholarship', 'countries', 'universities'));
    }

    public function update(Request $request, Scholarship $scholarship)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'university_id' => 'nullable|exists:universities,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'eligibility_criteria' => 'required|string',
            'application_deadline' => 'required|date',
            'required_documents' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $scholarship->update($validated);

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Scholarship updated successfully!');
    }

    public function destroy(Scholarship $scholarship)
    {
           if (Auth::user()->role !== 'admin') {
        abort(403, 'Only Admins can delete scholarship.');
    }
         

        $scholarship->delete();

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Scholarship deleted successfully!');
    }
}
