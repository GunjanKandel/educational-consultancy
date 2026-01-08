<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->paginate(10);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries',
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'requirements' => 'nullable|string',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('flag')) {
            $validated['flag'] = $request->file('flag')->store('countries', 'public');
        }

        Country::create($validated);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country added successfully!');
    }

    public function show(Country $country)
    {
        return view('admin.countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'requirements' => 'nullable|string',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('flag')) {
            if ($country->flag) {
                Storage::disk('public')->delete($country->flag);
            }
            $validated['flag'] = $request->file('flag')->store('countries', 'public');
        }

        $country->update($validated);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country updated successfully!');
    }

    public function destroy(Country $country)
    {
         if (Auth::user()->role !== 'admin') {
        abort(403, 'Only Admins can delete courses.');
    }
        // Manual auth check removed: Middleware handles this now!
        if ($country->flag) {
            Storage::disk('public')->delete($country->flag);
        }

        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country deleted successfully!');
    }
}