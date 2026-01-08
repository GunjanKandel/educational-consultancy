@extends('layouts.admin')

@section('title', 'Add New Testimonial')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Testimonials
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Add New Testimonial</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Student Name *</label>
                    <input type="text" name="student_name" class="form-control @error('student_name') is-invalid @enderror"
                           value="{{ old('student_name') }}" required>
                    @error('student_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Student Photo</label>
                    <input type="file" name="student_photo" class="form-control" accept="image/*">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <select name="country_id" class="form-select">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <select name="course_id" class="form-select">
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">University</label>
                    <input type="text" name="university" class="form-control" value="{{ old('university') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Rating</label>
                    <input type="number" name="rating" class="form-control" value="{{ old('rating') }}" min="1" max="5">
                </div>

                <div class="col-12">
                    <label class="form-label">Testimonial *</label>
                    <textarea name="testimonial" rows="4" class="form-control @error('testimonial') is-invalid @enderror" required>{{ old('testimonial') }}</textarea>
                    @error('testimonial')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Video URL</label>
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}">
                </div>

                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Testimonial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
