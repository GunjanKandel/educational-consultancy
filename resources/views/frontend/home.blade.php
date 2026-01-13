@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 animate-fade-in">
                <h1 class="display-4 fw-bold mb-3 mb-md-4">Your Gateway to Global Education</h1>
                <p class="lead mb-3 mb-md-4">Transform your future with expert guidance. We help students achieve their dreams of studying abroad in top universities worldwide.</p>
                <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-3">
                    <a href="{{ route('courses.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-search me-2"></i>Explore Courses
                    </a>
                    <a href="{{ route('application.create') }}" class="btn btn-outline-light btn-lg">
                        Apply Now <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 animate-fade-in" style="animation-delay: 0.2s;">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600"
     style="border:5px solid red;">

            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-3 g-md-4">
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-users fa-2x fa-md-3x"></i>
                    <h2 class="h3 h-md-2">{{ $stats['total_students'] }}+</h2>
                    <p class="mb-0 small">Students Placed</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-globe fa-2x fa-md-3x"></i>
                    <h2 class="h3 h-md-2">{{ $stats['total_countries'] }}+</h2>
                    <p class="mb-0 small">Countries</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-percentage fa-2x fa-md-3x"></i>
                    <h2 class="h3 h-md-2">{{ $stats['success_rate'] }}%</h2>
                    <p class="mb-0 small">Success Rate</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-university fa-2x fa-md-3x"></i>
                    <h2 class="h3 h-md-2">{{ $stats['partner_universities'] }}+</h2>
                    <p class="mb-0 small">Partner Universities</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="section-title">Featured Courses</h2>
            <p class="section-subtitle">Explore our most popular programs</p>
        </div>
        <div class="row g-3 g-md-4">
            @foreach($featured_courses as $course)
            <div class="col-sm-6 col-lg-4">
                <div class="card course-card h-100">
                    @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" class="card-img-top" alt="{{ $course->name }}">
                    @else
                    <div class="bg-gradient">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <span class="badge mb-2">{{ $course->country->name }}</span>
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($course->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                            <div>
                                <i class="fas fa-clock me-1" style="color: var(--secondary-color);"></i>
                                <small>{{ $course->duration }}</small>
                            </div>
                            @if($course->fee)
                            <div>
                                <strong style="color: var(--secondary-color);" class="small">{{ $course->currency }} {{ number_format($course->fee) }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-outline-primary w-100">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4 mt-md-5">
            <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg w-100 w-sm-auto">
                View All Courses <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Popular Countries -->
<section class="py-4 py-md-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="section-title">Study Destinations</h2>
            <p class="section-subtitle">Choose from top study destinations worldwide</p>
        </div>
        <div class="row g-3 g-md-4">
            @foreach($popular_countries as $country)
            <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('countries.show', $country->slug) }}" class="text-decoration-none">
                    <div class="card country-card text-center h-100">
                        <div class="card-body p-2 p-sm-3">
                            @if($country->flag)
                            <img src="{{ Storage::url($country->flag) }}" alt="{{ $country->name }}" class="img-fluid mb-2 mb-sm-3" style="height: 40px; object-fit: contain;">
                            @else
                            <i class="fas fa-flag fa-2x fa-sm-3x mb-2 mb-sm-3"></i>
                            @endif
                            <h6 class="mb-0 small">{{ $country->name }}</h6>
                            <small class="text-muted d-none d-sm-block">{{ $country->courses_count ?? 0 }} Courses</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">Comprehensive support for your educational journey</p>
        </div>
        <div class="row g-3 g-md-4">
            @foreach($services as $service)
            <div class="col-sm-6 col-lg-4">
                <div class="card service-card text-center h-100">
                    <!-- Service Image Added -->
                    @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" class="card-img-top" alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body p-3 p-sm-4">
                        <div class="mb-3">
                            @if($service->icon)
                            <i class="{{ $service->icon }} fa-2x fa-md-3x"></i>
                            @else
                            <i class="fas fa-cog fa-2x fa-md-3x"></i>
                            @endif
                        </div>
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($service->description, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- About Topics Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="section-title">About Our Approach</h2>
            <p class="section-subtitle">We believe in quality guidance and personal support</p>
        </div>
        <div class="row g-3 g-md-4">
            @foreach($aboutTopics as $topic)
            <div class="col-sm-6 col-lg-4">
                <div class="card about-topic-card text-center h-100 p-3">
                    @if($topic->icon)
                    <i class="{{ $topic->icon }} fa-2x fa-md-3x mb-2"></i>
                    @endif
                    <h5 class="card-title">{{ $topic->title }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($topic->description, 100) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
