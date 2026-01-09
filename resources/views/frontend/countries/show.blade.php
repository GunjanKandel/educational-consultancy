@extends('layouts.frontend')

@section('title', $country->name)

@section('content')
<!-- Country Header -->
<section class="hero-section" style="padding: 100px 0 60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb" style="background: transparent; padding: 0; margin: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8);">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('countries.index') }}" style="color: rgba(255,255,255,0.8);">Countries</a></li>
                        <li class="breadcrumb-item active" style="color: white;">{{ $country->name }}</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center mb-3">
                    @if($country->flag)
                    <img src="{{ Storage::url($country->flag) }}" alt="{{ $country->name }}" style="height: 60px; object-fit: contain;" class="me-3">
                    @endif
                    <h1 class="display-5 fw-bold mb-0">Study in {{ $country->name }}</h1>
                </div>
                <p class="lead mb-0">
                    <i class="fas fa-book-open me-2"></i>{{ $country->courses_count }} Courses Available
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Country Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Description -->
                @if($country->description)
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-info-circle me-2"></i>About {{ $country->name }}
                        </h3>
                        <p class="text-muted" style="line-height: 1.8; white-space: pre-line;">{{ $country->description }}</p>
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($country->benefits)
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-star me-2"></i>Why Study in {{ $country->name }}
                        </h3>
                        <p class="text-muted" style="line-height: 1.8; white-space: pre-line;">{{ $country->benefits }}</p>
                    </div>
                </div>
                @endif

                <!-- Requirements -->
                @if($country->requirements)
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-clipboard-check me-2"></i>Entry Requirements
                        </h3>
                        <p class="text-muted" style="line-height: 1.8; white-space: pre-line;">{{ $country->requirements }}</p>
                    </div>
                </div>
                @endif

                <!-- Available Courses -->
                @if($courses->count() > 0)
                <h3 class="fw-bold mb-4 mt-5" style="color: var(--primary-color);">Available Courses</h3>
                <div class="row g-4">
                    @foreach($courses as $course)
                    <div class="col-md-6">
                        <div class="card course-card h-100">
                            @if($course->image)
                            <img src="{{ Storage::url($course->image) }}" class="card-img-top" alt="{{ $course->name }}" style="height: 180px;">
                            @else
                            <div class="bg-gradient" style="height: 180px;">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($course->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small><i class="fas fa-clock me-1"></i>{{ $course->duration }}</small>
                                    @if($course->fee)
                                    <strong style="color: var(--secondary-color);">{{ $course->currency }} {{ number_format($course->fee) }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-outline-primary w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($courses->hasPages())
                <div class="mt-4">
                    {{ $courses->links() }}
                </div>
                @endif
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>No courses available for {{ $country->name }} at the moment. Please check back later.
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Universities -->
                @if($universities->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-university me-2"></i>Partner Universities
                        </h5>
                        @foreach($universities as $university)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            @if($university->logo)
                            <img src="{{ Storage::url($university->logo) }}" alt="{{ $university->name }}" style="width: 50px; height: 50px; object-fit: contain;" class="me-3">
                            @else
                            <div class="bg-light rounded p-2 me-3">
                                <i class="fas fa-university" style="color: var(--secondary-color);"></i>
                            </div>
                            @endif
                            <div>
                                <h6 class="mb-0 small">{{ $university->name }}</h6>
                                <small class="text-muted">{{ $university->location }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Scholarships -->
                @if($scholarships->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-graduation-cap me-2"></i>Scholarships Available
                        </h5>
                        @foreach($scholarships as $scholarship)
                        <div class="mb-3 pb-3 border-bottom">
                            <h6 class="small mb-1">{{ $scholarship->title }}</h6>
                            <p class="text-muted small mb-1">{{ Str::limit($scholarship->description, 80) }}</p>
                            <strong style="color: var(--accent-color); font-size: 0.9rem;">{{ $scholarship->currency }} {{ number_format($scholarship->amount) }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
