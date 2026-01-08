<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('country')->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $countries = Country::where('is_active', true)->get();
        return view('admin.courses.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|string|max:100',
            'fee' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'requirements' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name); // Using $request directly is safer here

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course added successfully!');
    }

    public function show(Course $course)
    {
        $course->load('country');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $countries = Country::where('is_active', true)->get();
        return view('admin.courses.edit', compact('course', 'countries'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|string|max:100',
            'fee' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'requirements' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
{
    // Only Admin can delete
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Only Admins can delete courses.');
    }

    if ($course->image) {
        Storage::disk('public')->delete($course->image);
    }

    $course->delete();

    return redirect()->route('admin.courses.index')
        ->with('success', 'Course deleted successfully!');
}
}