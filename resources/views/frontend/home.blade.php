{{-- resources/views/frontend/home.blade.php --}}
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
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&h=600&fit=crop&q=80" 
                     alt="Students studying together" 
                     class="img-fluid rounded shadow-lg w-100">
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
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h2>{{ $stats['total_students'] }}+</h2>
                    <p class="mb-0">Students Placed</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-globe fa-3x mb-3"></i>
                    <h2>{{ $stats['total_countries'] }}+</h2>
                    <p class="mb-0">Countries</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-percentage fa-3x mb-3"></i>
                    <h2>{{ $stats['success_rate'] }}%</h2>
                    <p class="mb-0">Success Rate</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <i class="fas fa-university fa-3x mb-3"></i>
                    <h2>{{ $stats['partner_universities'] }}+</h2>
                    <p class="mb-0">Partner Universities</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Featured Courses</h2>
            <p class="section-subtitle">Explore our most popular programs</p>
        </div>
        <div class="row g-4">
            @foreach($featured_courses as $course)
            <div class="col-md-6 col-lg-4">
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
                        <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                            <div>
                                <i class="fas fa-clock me-1" style="color: var(--secondary-color);"></i>
                                <small>{{ $course->duration }}</small>
                            </div>
                            @if($course->fee)
                            <div>
                                <strong style="color: var(--secondary-color);">{{ $course->currency }} {{ number_format($course->fee) }}</strong>
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
        <div class="text-center mt-5">
            <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">
                View All Courses <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Popular Countries -->
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Study Destinations</h2>
            <p class="section-subtitle">Choose from top study destinations worldwide</p>
        </div>
        <div class="row g-4">
            @foreach($popular_countries as $country)
            <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('countries.show', $country->slug) }}" class="text-decoration-none">
                    <div class="card country-card text-center h-100">
                        <div class="card-body">
                            @if($country->flag)
                            <img src="{{ Storage::url($country->flag) }}" alt="{{ $country->name }}" class="img-fluid mb-3" style="height: 50px; object-fit: contain;">
                            @else
                            <i class="fas fa-flag fa-3x mb-3"></i>
                            @endif
                            <h6 class="mb-1">{{ $country->name }}</h6>
                            <small class="text-muted">{{ $country->courses_count ?? 0 }} Courses</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">Comprehensive support for your educational journey</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card service-card text-center h-100">
                    @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" class="card-img-top" alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <div class="mb-3">
                            @if($service->icon)
                            <i class="{{ $service->icon }} fa-3x"></i>
                            @else
                            <i class="fas fa-cog fa-3x"></i>
                            @endif
                        </div>
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($service->description, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Our Team -->
@if(isset($teams) && $teams->count() > 0)
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Meet Our Expert Team</h2>
            <p class="section-subtitle">Experienced counselors dedicated to your success</p>
        </div>
        <div class="row g-4">
            @foreach($teams as $member)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center h-100 border-0 shadow-sm">
                    <div class="card-body">
                        @if($member->photo)
                        <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 100px; height: 100px; background: var(--gradient-accent); color: white;">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                        @endif
                        <h6 class="mb-1" style="color: var(--primary-color); font-weight: 700;">{{ $member->name }}</h6>
                        <small class="text-muted d-block mb-2">{{ $member->designation }}</small>
                        @if($member->expertise)
                        <p class="small text-muted mb-0">{{ Str::limit($member->expertise, 60) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('team') }}" class="btn btn-outline-primary btn-lg">View All Team Members</a>
        </div>
    </div>
</section>
@endif

<!-- Branches/Offices -->
@if(isset($branches) && $branches->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Offices</h2>
            <p class="section-subtitle">Visit us at any of our convenient locations</p>
        </div>
        <div class="row g-4">
            @foreach($branches as $branch)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-map-marker-alt fa-2x" style="color: var(--secondary-color);"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1" style="color: var(--primary-color);">{{ $branch->name }}</h5>
                                <p class="text-muted mb-2">{{ $branch->address }}</p>
                                @if($branch->phone)
                                <p class="mb-1"><i class="fas fa-phone me-2" style="color: var(--secondary-color);"></i><small>{{ $branch->phone }}</small></p>
                                @endif
                                @if($branch->email)
                                <p class="mb-0"><i class="fas fa-envelope me-2" style="color: var(--secondary-color);"></i><small>{{ $branch->email }}</small></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
@if(isset($testimonials) && $testimonials->count() > 0)
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Student Success Stories</h2>
            <p class="section-subtitle">Hear from students who achieved their dreams</p>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
            <div class="col-md-6 col-lg-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($testimonial->student_photo)
                            <img src="{{ Storage::url($testimonial->student_photo) }}" alt="{{ $testimonial->student_name }}" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; background: var(--gradient-accent); color: white;">
                                <i class="fas fa-user"></i>
                            </div>
                            @endif
                            <div>
                                <h6 class="mb-0" style="color: var(--primary-color); font-weight: 700;">{{ $testimonial->student_name }}</h6>
                                <small class="text-muted">{{ $testimonial->country->name }}</small>
                            </div>
                        </div>
                        <div class="mb-2">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="card-text text-muted">"{{ Str::limit($testimonial->testimonial, 120) }}"</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- About Topics Section -->
@if(isset($aboutTopics) && $aboutTopics->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">About Our Approach</h2>
            <p class="section-subtitle">We believe in quality guidance and personal support</p>
        </div>
        <div class="row g-4">
            @foreach($aboutTopics as $topic)
            <div class="col-md-6 col-lg-4">
                <div class="card about-topic-card text-center h-100">
                    <div class="card-body">
                        @if($topic->icon)
                        <i class="{{ $topic->icon }} fa-3x mb-3"></i>
                        @endif
                        <h5 class="card-title">{{ $topic->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($topic->description, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="cta-section text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Ready to Start Your Journey?</h2>
        <p class="lead mb-4">Join thousands of students who have successfully achieved their study abroad dreams</p>
        <a href="{{ route('application.create') }}" class="btn btn-light btn-lg">
            <i class="fas fa-paper-plane me-2"></i>Apply Now
        </a>
    </div>
</section>
@endsection