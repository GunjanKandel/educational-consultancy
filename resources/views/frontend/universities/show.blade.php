@extends('layouts.frontend')

@section('title', $university->name)

@section('content')
<!-- University Header -->
<section class="py-5" style="background: var(--gradient-primary); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('universities.index') }}" class="text-white">Universities</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $university->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">{{ $university->name }}</h1>
                <p class="lead mb-3">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {{ $university->location ?? $university->country->name }}
                </p>
                @if($university->world_ranking)
                <p class="mb-0">
                    <strong><i class="fas fa-trophy me-2"></i>World Ranking: #{{ $university->world_ranking }}</strong>
                </p>
                @endif
            </div>
            <div class="col-lg-4 text-center">
                @if($university->logo)
                    <img src="{{ Storage::url($university->logo) }}" 
                         alt="{{ $university->name }}"
                         class="img-fluid bg-white p-4 rounded shadow"
                         style="max-height: 200px; object-fit: contain;">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- University Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: var(--primary-color);">About {{ $university->name }}</h3>
                        <p class="text-muted" style="line-height: 1.8;">
                            {{ $university->description ?? 'No description available.' }}
                        </p>
                    </div>
                </div>

                <!-- Scholarships -->
                @if($university->scholarships->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-graduation-cap me-2"></i>Available Scholarships
                        </h3>
                        <div class="row g-3">
                            @foreach($university->scholarships as $scholarship)
                            <div class="col-md-6">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h6>{{ $scholarship->title }}</h6>
                                        <p class="text-muted small mb-2">{{ Str::limit($scholarship->description, 80) }}</p>
                                        <p class="mb-0">
                                            <strong style="color: var(--secondary-color);">
                                                Amount: {{ $scholarship->amount }}
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Info -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="mb-3" style="color: var(--primary-color);">Quick Information</h5>
                        
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Country</small>
                            <strong>{{ $university->country->name }}</strong>
                        </div>

                        @if($university->location)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Location</small>
                            <strong>{{ $university->location }}</strong>
                        </div>
                        @endif

                        @if($university->world_ranking)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">World Ranking</small>
                            <strong>#{{ $university->world_ranking }}</strong>
                        </div>
                        @endif

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Partnership Level</small>
                            <span class="badge 
                                @if($university->partnership_level === 'gold') bg-warning text-dark
                                @elseif($university->partnership_level === 'silver') bg-secondary
                                @else bg-info
                                @endif">
                                {{ ucfirst($university->partnership_level) }}
                            </span>
                        </div>

                        @if($university->website)
                        <hr>
                        <a href="{{ $university->website }}" 
                           target="_blank" 
                           class="btn btn-outline-primary w-100">
                            <i class="fas fa-external-link-alt me-2"></i>Visit Website
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Apply Now -->
                <div class="card shadow-sm" style="background: var(--gradient-primary); color: white;">
                    <div class="card-body p-4 text-center">
                        <h5 class="mb-3">Interested in {{ $university->name }}?</h5>
                        <p class="mb-3">Get expert guidance for your application</p>
                        <a href="{{ route('application.create') }}" class="btn btn-light w-100">
                            <i class="fas fa-paper-plane me-2"></i>Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Universities -->
@if($relatedUniversities->count() > 0)
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <h3 class="text-center mb-5" style="color: var(--primary-color);">
            More Universities in {{ $university->country->name }}
        </h3>
        <div class="row g-4">
            @foreach($relatedUniversities as $related)
            <div class="col-md-4">
                <div class="card university-card h-100">
                    <div class="text-center p-4" style="background: white;">
                        @if($related->logo)
                            <img src="{{ Storage::url($related->logo) }}" 
                                 alt="{{ $related->name }}"
                                 class="img-fluid"
                                 style="max-height: 80px; object-fit: contain;">
                        @else
                            <i class="fas fa-university fa-3x" style="color: var(--secondary-color);"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ $related->name }}</h6>
                        @if($related->world_ranking)
                        <p class="text-muted small mb-2">
                            <i class="fas fa-trophy me-1"></i>Rank: #{{ $related->world_ranking }}
                        </p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('universities.show', $related->slug) }}" 
                           class="btn btn-outline-primary btn-sm w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.breadcrumb {
    background: transparent;
    margin: 0;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: white;
}

.card {
    border: none;
    border-radius: 15px;
}
</style>
@endsection
