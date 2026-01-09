@extends('layouts.frontend')

@section('title', 'Study Destinations')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Study Destinations</h1>
                <p class="lead mb-0">Explore top countries for international education and find your perfect study destination</p>
            </div>
        </div>
    </div>
</section>

<!-- Countries Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($countries as $country)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('countries.show', $country->slug) }}" class="text-decoration-none">
                    <div class="card country-card text-center h-100">
                        <div class="card-body p-4">
                            @if($country->flag)
                            <img src="{{ Storage::url($country->flag) }}" alt="{{ $country->name }}" class="img-fluid mb-3" style="height: 80px; object-fit: contain;">
                            @else
                            <i class="fas fa-flag fa-4x mb-3" style="color: var(--secondary-color);"></i>
                            @endif
                            <h5 class="mb-2 fw-bold" style="color: var(--primary-color);">{{ $country->name }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-book-open me-1"></i>{{ $country->courses_count }} Courses Available
                            </p>
                            @if($country->is_popular)
                            <span class="badge" style="background: var(--accent-color);">
                                <i class="fas fa-star"></i> Popular
                            </span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-globe fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No countries available</h4>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($countries->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $countries->links() }}
        </div>
        @endif
    </div>
</section>
@endsection