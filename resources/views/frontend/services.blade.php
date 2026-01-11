@extends('layouts.frontend')

@section('title', 'Our Services')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Our Services</h1>
                <p class="lead mb-0">Comprehensive support for your educational journey</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-sm-6 col-lg-4">
                <div class="card service-card h-100 border-0 shadow-sm">
                    <!-- Service Image -->
                    @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" class="card-img-top" alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            @if($service->icon)
                            <i class="{{ $service->icon }} fa-4x" style="color: var(--secondary-color);"></i>
                            @else
                            <i class="fas fa-cog fa-4x" style="color: var(--secondary-color);"></i>
                            @endif
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--primary-color);">{{ $service->title }}</h4>
                        <p class="text-muted" style="line-height: 1.8;">{{ $service->description }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-concierge-bell fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No services available</h4>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-2" style="color: var(--primary-color);">Ready to Start Your Journey?</h3>
                <p class="text-muted mb-0">Let our experts guide you through every step of your study abroad journey</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-phone me-2"></i>Contact Us
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
