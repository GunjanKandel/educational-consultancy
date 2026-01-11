@extends('layouts.frontend')

@section('title', 'Events')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Events & Webinars</h1>
                <p class="lead mb-0">Join our educational events and webinars</p>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events -->
@if($upcoming_events->count() > 0)
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">Upcoming Events</h3>
        <div class="row g-4">
            @foreach($upcoming_events as $event)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    @if($event->featured_image)
                    <img src="{{ Storage::url($event->featured_image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-gradient" style="height: 200px; display: flex; align-items: center; justify-content: center; background: var(--gradient-accent) !important;">
                        <i class="fas fa-calendar fa-3x" style="color: white;"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <span class="badge mb-2" style="background: var(--accent-color);">{{ ucfirst($event->type) }}</span>
                        <h5 class="fw-bold">{{ $event->title }}</h5>
                        <p class="text-muted small">{{ Str::limit($event->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>{{ $event->event_date->format('M d, Y') }}</span>
                            <span><i class="fas fa-clock me-1"></i>{{ $event->event_date->format('h:i A') }}</span>
                        </div>
                        @if($event->venue)
                        <p class="text-muted small mt-2 mb-0"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->venue }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Past Events -->
@if($past_events->count() > 0)
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">Past Events</h3>
        <div class="row g-4">
            @foreach($past_events as $event)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    @if($event->featured_image)
                    <img src="{{ Storage::url($event->featured_image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover; filter: grayscale(30%);">
                    @endif
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">{{ ucfirst($event->type) }}</span>
                        <h6 class="fw-bold">{{ $event->title }}</h6>
                        <p class="text-muted small mb-2">{{ Str::limit($event->description, 80) }}</p>
                        <small class="text-muted"><i class="fas fa-calendar me-1"></i>{{ $event->event_date->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
