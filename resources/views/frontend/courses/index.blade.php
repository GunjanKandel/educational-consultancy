@extends('layouts.frontend')

@section('title', 'Courses')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Explore Our Courses</h1>
                <p class="lead mb-0">Find the perfect program to achieve your educational goals</p>
            </div>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="py-4" style="background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div class="container">
        <form method="GET" action="{{ route('courses.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Search Courses</label>
                    <input type="text" name="search" class="form-control" placeholder="Search by course name..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Country</label>
                    <select name="country_id" class="form-select">
                        <option value="">All Countries</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Sort By</label>
                    <select name="sort" class="form-select">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="fee_low" {{ request('sort') == 'fee_low' ? 'selected' : '' }}>Fee (Low to High)</option>
                        <option value="fee_high" {{ request('sort') == 'fee_high' ? 'selected' : '' }}>Fee (High to Low)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Courses Grid -->
<section class="py-5">
    <div class="container">
        @if(request('search') || request('country_id'))
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span>
                <i class="fas fa-filter me-2"></i>
                Showing {{ $courses->total() }} results
                @if(request('search'))
                for "<strong>{{ request('search') }}</strong>"
                @endif
            </span>
            <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-times me-1"></i>Clear Filters
            </a>
        </div>
        @endif

        <div class="row g-4">
            @forelse($courses as $course)
            <div class="col-md-6 col-lg-4">
                <div class="card course-card">
                    @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" class="card-img-top" alt="{{ $course->name }}">
                    @else
                    <div class="bg-gradient">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <span class="badge mb-2">{{ $course->country->name }}</span>
                        @if($course->is_featured)
                        <span class="badge bg-warning text-dark ms-1">
                            <i class="fas fa-star"></i> Featured
                        </span>
                        @endif
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
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
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No courses found</h4>
                    <p class="text-muted">Try adjusting your search or filters</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">View All Courses</a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $courses->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
