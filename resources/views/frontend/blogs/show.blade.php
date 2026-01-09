@extends('layouts.frontend')

@section('title', $blog->title)

@section('content')
<!-- Article Header -->
<section class="hero-section" style="padding: 100px 0 60px;">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="background: transparent; padding: 0; margin: 0;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}" style="color: rgba(255,255,255,0.8);">Blog</a></li>
                <li class="breadcrumb-item active" style="color: white;">Article</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                @if($blog->category)
                <span class="badge mb-3" style="background: var(--accent-color); font-size: 0.9rem;">{{ $blog->category }}</span>
                @endif
                <h1 class="display-5 fw-bold mb-4">{{ $blog->title }}</h1>
                <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
                    <span><i class="fas fa-user me-2"></i>{{ $blog->user->name }}</span>
                    <span><i class="fas fa-calendar me-2"></i>{{ $blog->published_at->format('F d, Y') }}</span>
                    <span><i class="fas fa-eye me-2"></i>{{ $blog->views }} views</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                @if($blog->featured_image)
                <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid rounded-3 shadow-lg mb-5 w-100" style="max-height: 500px; object-fit: cover;">
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <article style="font-size: 1.1rem; line-height: 1.8; color: var(--dark-text);">
                            {!! nl2br(e($blog->content)) !!}
                        </article>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($related_posts->count() > 0)
                <div class="mt-5">
                    <h3 class="fw-bold mb-4" style="color: var(--primary-color);">Related Articles</h3>
                    <div class="row g-4">
                        @foreach($related_posts as $related)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="fw-bold">
                                        <a href="{{ route('blogs.show', $related->slug) }}" class="text-decoration-none" style="color: var(--primary-color);">
                                            {{ $related->title }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $related->published_at->format('M d, Y') }}</small>
                                </div>
                            </div>
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