@extends('layouts.frontend')

@section('title', $course->name)

@section('content')
<!-- Course Header -->
<section class="hero-section" style="padding: 100px 0 60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb" style="background: transparent; padding: 0; margin: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8);">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" style="color: rgba(255,255,255,0.8);">Courses</a></li>
                        <li class="breadcrumb-item active" style="color: white;">{{ $course->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">{{ $course->name }}</h1>
                <p class="lead mb-4">
                    <i class="fas fa-globe me-2"></i>{{ $course->country->name }}
                    @if($course->is_featured)
                    <span class="badge bg-warning text-dark ms-2">
                        <i class="fas fa-star"></i> Featured
                    </span>
                    @endif
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('application.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Course Details -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Course Image -->
                @if($course->image)
                <div class="mb-4">
                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->name }}" class="img-fluid rounded-3 shadow-lg w-100" style="max-height: 400px; object-fit: cover;">
                </div>
                @endif

                <!-- Description -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-info-circle me-2"></i>Course Description
                        </h3>
                        <p class="text-muted" style="line-height: 1.8;">{{ $course->description }}</p>
                    </div>
                </div>

                <!-- Requirements -->
                @if($course->requirements)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-clipboard-check me-2"></i>Entry Requirements
                        </h3>
                        <p class="text-muted" style="line-height: 1.8; white-space: pre-line;">{{ $course->requirements }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Course Info Card -->
                <div class="card border-0 shadow-lg mb-4" style="position: sticky; top: 100px;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4" style="color: var(--primary-color);">Course Information</h4>
                        
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-clock me-2" style="color: var(--secondary-color);"></i>Duration
                                </span>
                                <strong>{{ $course->duration }}</strong>
                            </div>
                        </div>

                        @if($course->fee)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-money-bill-wave me-2" style="color: var(--secondary-color);"></i>Tuition Fee
                                </span>
                                <strong style="color: var(--secondary-color);">{{ $course->currency }} {{ number_format($course->fee) }}</strong>
                            </div>
                        </div>
                        @endif

                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-globe me-2" style="color: var(--secondary-color);"></i>Country
                                </span>
                                <strong>{{ $course->country->name }}</strong>
                            </div>
                        </div>

                        <a href="{{ route('application.create') }}" class="btn btn-primary w-100 btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Apply for this Course
                        </a>

                        <div class="mt-3 text-center">
                            <small class="text-muted">Need help? <a href="{{ route('contact.index') }}">Contact us</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Courses -->
        @if($related_courses->count() > 0)
        <section class="mt-5 pt-5">
            <h3 class="fw-bold mb-4" style="color: var(--primary-color);">Related Courses in {{ $course->country->name }}</h3>
            <div class="row g-4">
                @foreach($related_courses as $related)
                <div class="col-md-4">
                    <div class="card course-card">
                        @if($related->image)
                        <img src="{{ Storage::url($related->image) }}" class="card-img-top" alt="{{ $related->name }}">
                        @else
                        <div class="bg-gradient">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <span class="badge mb-2">{{ $related->country->name }}</span>
                            <h5 class="card-title">{{ $related->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($related->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="fas fa-clock me-1"></i>{{ $related->duration }}</small>
                                @if($related->fee)
                                <strong style="color: var(--secondary-color); font-size: 0.9rem;">{{ $related->currency }} {{ number_format($related->fee) }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('courses.show', $related->slug) }}" class="btn btn-outline-primary w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</section>
@endsection