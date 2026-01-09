@extends('layouts.frontend')

@section('title', 'Contact Us')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
                <p class="lead mb-0">Get in touch with our expert team for any questions or guidance</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="fw-bold mb-4" style="color: var(--primary-color);">Send us a Message</h3>

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Address *</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone Number *</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Subject</label>
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Message *</label>
                                    <textarea name="message" rows="6" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info Sidebar -->
            <div class="col-lg-4">
                <!-- Contact Details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-map-marker-alt me-2"></i>Contact Information
                        </h5>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-phone fa-lg me-3 mt-1" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="text-muted mb-0">+977 123456789</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-envelope fa-lg me-3 mt-1" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="text-muted mb-0">info@educonsult.com</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <i class="fas fa-map-marker-alt fa-lg me-3 mt-1" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="text-muted mb-0">Bharatpur, Chitwan, Nepal</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top">
                            <h6 class="mb-3">Office Hours</h6>
                            <p class="text-muted small mb-1">Sunday - Friday: 10:00 AM - 6:00 PM</p>
                            <p class="text-muted small mb-0">Saturday: Closed</p>
                        </div>
                    </div>
                </div>

                <!-- Branches -->
                @if($branches->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-building me-2"></i>Our Branches
                        </h5>
                        @foreach($branches as $branch)
                        <div class="mb-3 pb-3 border-bottom">
                            <h6 class="mb-1">{{ $branch->name }}</h6>
                            <p class="text-muted small mb-1">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $branch->city }}, {{ $branch->country }}
                            </p>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-phone me-1"></i>{{ $branch->phone }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection