@extends('layouts.frontend')

@section('title', 'Scholarships')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Scholarships</h1>
                <p class="lead mb-0">Discover financial aid opportunities for your studies abroad</p>
            </div>
        </div>
    </div>
</section>

<!-- Scholarships Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($scholarships as $scholarship)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge" style="background: var(--accent-color);">{{ $scholarship->country->name }}</span>
                            <h4 class="fw-bold mb-0" style="color: var(--secondary-color);">{{ $scholarship->currency }} {{ number_format($scholarship->amount) }}</h4>
                        </div>
                        <h5 class="fw-bold mb-3">{{ $scholarship->title }}</h5>
                        <p class="text-muted small">{{ Str::limit($scholarship->description, 120) }}</p>
                        @if($scholarship->university)
                        <p class="text-muted small mb-2"><i class="fas fa-university me-2"></i>{{ $scholarship->university->name }}</p>
                        @endif
                        <div class="mb-3">
                            <strong class="small" style="color: var(--primary-color);">Deadline:</strong>
                            <p class="text-muted small mb-0">{{ $scholarship->application_deadline->format('F d, Y') }}</p>
                        </div>
                        <a href="{{ route('application.create') }}" class="btn btn-outline-primary w-100">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No scholarships available at the moment</h4>
                <p class="text-muted">Please check back later for new opportunities</p>
            </div>
            @endforelse
        </div>

        @if($scholarships->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $scholarships->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
