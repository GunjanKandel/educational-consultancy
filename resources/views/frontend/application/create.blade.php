@extends('layouts.frontend')

@section('title', 'Apply Now')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Apply Now</h1>
                <p class="lead mb-0">Take the first step towards your international education journey</p>
            </div>
        </div>
    </div>
</section>

<!-- Application Form -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('application.store') }}">
                            @csrf

                            <!-- Personal Information -->
                            <h4 class="fw-bold mb-4" style="color: var(--primary-color);">
                                <i class="fas fa-user me-2"></i>Personal Information
                            </h4>
                            
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Address *</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone Number *</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Date of Birth *</label>
                                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nationality *</label>
                                    <input type="text" name="nationality" class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality') }}" required>
                                    @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Passport Number *</label>
                                    <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" value="{{ old('passport_number') }}" required>
                                    @error('passport_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Address *</label>
                                    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <h4 class="fw-bold mb-4" style="color: var(--primary-color);">
                                <i class="fas fa-graduation-cap me-2"></i>Academic Information
                            </h4>

                            <div class="row g-3 mb-5">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Course You Want to Apply *</label>
                                    <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                        <option value="">Select a course</option>
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }} - {{ $course->country->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Highest Qualification *</label>
                                    <input type="text" name="highest_qualification" class="form-control @error('highest_qualification') is-invalid @enderror" value="{{ old('highest_qualification') }}" placeholder="e.g., Bachelor's Degree" required>
                                    @error('highest_qualification')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">GPA / Percentage *</label>
                                    <input type="number" step="0.01" name="gpa_percentage" class="form-control @error('gpa_percentage') is-invalid @enderror" value="{{ old('gpa_percentage') }}" placeholder="e.g., 3.5 or 75" required>
                                    @error('gpa_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">English Proficiency Test *</label>
                                    <select name="english_test" class="form-select @error('english_test') is-invalid @enderror" required>
                                        <option value="">Select test</option>
                                        <option value="IELTS" {{ old('english_test') == 'IELTS' ? 'selected' : '' }}>IELTS</option>
                                        <option value="TOEFL" {{ old('english_test') == 'TOEFL' ? 'selected' : '' }}>TOEFL</option>
                                        <option value="PTE" {{ old('english_test') == 'PTE' ? 'selected' : '' }}>PTE</option>
                                        <option value="Duolingo" {{ old('english_test') == 'Duolingo' ? 'selected' : '' }}>Duolingo</option>
                                        <option value="None" {{ old('english_test') == 'None' ? 'selected' : '' }}>Not Taken Yet</option>
                                    </select>
                                    @error('english_test')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Test Score (if applicable)</label>
                                    <input type="number" step="0.1" name="english_score" class="form-control @error('english_score') is-invalid @enderror" value="{{ old('english_score') }}" placeholder="e.g., 7.0">
                                    @error('english_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Note:</strong> After submitting your application, you will receive a confirmation email with your application number. Our team will review your application and contact you within 3-5 business days.
                            </div>

                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
