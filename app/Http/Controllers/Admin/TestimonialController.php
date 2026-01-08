<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Country;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with(['country', 'course'])
            ->latest()
            ->paginate(10);
        
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $countries = Country::where('is_active', true)->get();
        $courses = Course::where('is_active', true)->get();
        return view('admin.testimonials.create', compact('countries', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'country_id' => 'required|exists:countries,id',
            'course_id' => 'nullable|exists:courses,id',
            'university' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('student_photo')) {
            $validated['student_photo'] = $request->file('student_photo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial added successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        $countries = Country::where('is_active', true)->get();
        $courses = Course::where('is_active', true)->get();
        return view('admin.testimonials.edit', compact('testimonial', 'countries', 'courses'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'country_id' => 'required|exists:countries,id',
            'course_id' => 'nullable|exists:courses,id',
            'university' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('student_photo')) {
            if ($testimonial->student_photo) {
                Storage::disk('public')->delete($testimonial->student_photo);
            }
            $validated['student_photo'] = $request->file('student_photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
       if (Auth::user()->role !== 'admin') {
        abort(403, 'Only Admins can delete courses.');
        }

        if ($testimonial->student_photo) {
            Storage::disk('public')->delete($testimonial->student_photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }
}