@extends('layouts.frontend')

@section('title', 'Our Team')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Our Team</h1>
                <p class="lead mb-0">Meet the experts who will guide your educational journey</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($teams as $member)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    @if($member->photo)
                    <img src="{{ Storage::url($member->photo) }}" class="card-img-top" alt="{{ $member->name }}" style="height: 300px; object-fit: cover;">
                    @else
                    <div class="bg-gradient" style="height: 300px; display: flex; align-items: center; justify-content: center; background: var(--gradient-accent) !important;">
                        <i class="fas fa-user fa-4x" style="color: white;"></i>
                    </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                        <p class="text-muted small mb-2">{{ $member->designation }}</p>
                        @if($member->expertise)
                        <p class="text-muted small mb-3"><em>{{ $member->expertise }}</em></p>
                        @endif
                        @if($member->bio)
                        <p class="text-muted small">{{ Str::limit($member->bio, 100) }}</p>
                        @endif
                        <div class="mt-3">
                            @if($member->email)
                            <a href="mailto:{{ $member->email }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-envelope"></i>
                            </a>
                            @endif
                            @if($member->linkedin)
                            <a href="{{ $member->linkedin }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            @endif
                            @if($member->facebook)
                            <a href="{{ $member->facebook }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fab fa-facebook"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No team members available</h4>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($teams) && $teams->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $teams->links() }}
        </div>
        @endif
    </div>
</section>
@endsection