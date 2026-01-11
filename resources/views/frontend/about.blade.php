@extends('layouts.frontend')

@section('title', 'About Us')

@section('content')

<!-- Page Header -->
<section class="hero-section py-5" style="padding: 120px 0 80px;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">About Us</h1>
        <p class="lead mb-0">Your trusted partner in international education</p>
    </div>
</section>

<!-- About Topics -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($aboutTopics as $topic)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        @if($topic->icon)
                            <i class="{{ $topic->icon }} fa-3x mb-3" style="color: var(--primary-color);"></i>
                        @endif
                        <h5 class="fw-bold mb-2">{{ $topic->title }}</h5>
                        <p class="text-muted">{{ $topic->description }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No topics found.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
