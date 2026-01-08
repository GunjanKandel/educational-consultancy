<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::with('country')
            ->latest()
            ->paginate(10);

        return view('admin.universities.index', compact('universities'));
    }

    public function create()
    {
        $countries = Country::where('is_active', true)->get();

        return view('admin.universities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id'         => 'required|exists:countries,id',
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'logo'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location'           => 'nullable|string|max:255',
            'world_ranking'      => 'nullable|integer|min:1',
            'website'            => 'nullable|url',
            'partnership_level'  => 'required|in:gold,silver,bronze',
            'is_active'          => 'nullable|boolean',
        ]);

        // Auto-generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Handle checkbox safely
        $validated['is_active'] = $request->boolean('is_active');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('universities', 'public');
        }

        University::create($validated);

        return redirect()
            ->route('admin.universities.index')
            ->with('success', 'University added successfully!');
    }

    public function edit(University $university)
    {
        $countries = Country::where('is_active', true)->get();

        return view('admin.universities.edit', compact('university', 'countries'));
    }

    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'country_id'         => 'required|exists:countries,id',
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'logo'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location'           => 'nullable|string|max:255',
            'world_ranking'      => 'nullable|integer|min:1',
            'website'            => 'nullable|url',
            'partnership_level'  => 'required|in:gold,silver,bronze',
            'is_active'          => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($university->logo) {
                Storage::disk('public')->delete($university->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('universities', 'public');
        }

        $university->update($validated);

        return redirect()
            ->route('admin.universities.index')
            ->with('success', 'University updated successfully!');
    }

    public function destroy(University $university)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Only Admins can delete university data.');
        }

        if ($university->logo) {
            Storage::disk('public')->delete($university->logo);
        }

        $university->delete();

        return redirect()
            ->route('admin.universities.index')
            ->with('success', 'University deleted successfully!');
    }
}
