@extends('layouts.frontend')

@section('title', 'Universities')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: var(--gradient-primary); color: white;">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Partner Universities</h1>
            <p class="lead mb-0">Explore our network of world-class educational institutions</p>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section class="py-4" style="background: var(--light-bg);">
    <div class="container">
        <form method="GET" action="{{ route('universities.index') }}" class="row g-3">
            <!-- Search -->
            <div class="col-md-4">
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Search universities..."
                       value="{{ request('search') }}">
            </div>

            <!-- Country Filter -->
            <div class="col-md-3">
                <select name="country" class="form-select">
                    <option value="">All Countries</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }} ({{ $country->universities_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Partnership Filter -->
            <div class="col-md-2">
                <select name="partnership" class="form-select">
                    <option value="">All Partnerships</option>
                    <option value="gold" {{ request('partnership') == 'gold' ? 'selected' : '' }}>Gold</option>
                    <option value="silver" {{ request('partnership') == 'silver' ? 'selected' : '' }}>Silver</option>
                    <option value="bronze" {{ request('partnership') == 'bronze' ? 'selected' : '' }}>Bronze</option>
                </select>
            </div>

            <!-- Sort -->
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="">Sort By</option>
                    <option value="ranking_asc" {{ request('sort') == 'ranking_asc' ? 'selected' : '' }}>Ranking (Low to High)</option>
                    <option value="ranking_desc" {{ request('sort') == 'ranking_desc' ? 'selected' : '' }}>Ranking (High to Low)</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Universities Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($universities as $university)
            <div class="col-md-6 col-lg-4">
                <div class="card university-card h-100">
                    <!-- Logo -->
                    <div class="text-center p-4" style="background: var(--light-bg);">
                        @if($university->logo)
                            <img src="{{ Storage::url($university->logo) }}" 
                                 alt="{{ $university->name }}"
                                 class="img-fluid"
                                 style="max-height: 100px; object-fit: contain;">
                        @else
                            <i class="fas fa-university fa-4x" style="color: var(--secondary-color);"></i>
                        @endif
                    </div>

                    <div class="card-body">
                        <!-- Partnership Badge -->
                        <span class="badge mb-2 
                            @if($university->partnership_level === 'gold') bg-warning text-dark
                            @elseif($university->partnership_level === 'silver') bg-secondary
                            @else bg-info
                            @endif">
                            {{ ucfirst($university->partnership_level) }} Partner
                        </span>

                        <!-- University Name -->
                        <h5 class="card-title mb-2">{{ $university->name }}</h5>

                        <!-- Country & Location -->
                        <p class="text-muted small mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ $university->location ?? $university->country->name }}
                        </p>

                        <!-- World Ranking -->
                        @if($university->world_ranking)
                        <p class="mb-2">
                            <strong style="color: var(--secondary-color);">
                                <i class="fas fa-trophy me-1"></i>
                                World Ranking: #{{ $university->world_ranking }}
                            </strong>
                        </p>
                        @endif

                        <!-- Description -->
                        <p class="card-text text-muted small">
                            {{ Str::limit($university->description, 120) }}
                        </p>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('universities.show', $university->slug) }}" 
                           class="btn btn-outline-primary w-100">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-university fa-4x text-muted mb-3"></i>
                    <h4>No Universities Found</h4>
                    <p class="text-muted">Try adjusting your filters</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $universities->links() }}
        </div>
    </div>
</section>

<style>
.university-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
}

.university-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(8, 131, 149, 0.25);
}

.university-card .card-title {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.1rem;
}

.university-card .card-footer {
    background: transparent;
    border: none;
    padding: 1rem 1.5rem 1.5rem;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 0.6rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 0.2rem rgba(8, 131, 149, 0.25);
}
</style>
@endsection
