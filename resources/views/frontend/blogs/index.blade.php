@extends('layouts.frontend')

@section('title', 'Blog')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Our Blog</h1>
                <p class="lead mb-0">Latest news, tips, and insights about studying abroad</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Search -->
                <form method="GET" class="mb-4">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control" placeholder="Search articles..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <div class="row g-4">
                    @forelse($blogs as $blog)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($blog->featured_image)
                            <img src="{{ Storage::url($blog->featured_image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                            @else
                            <div class="bg-gradient" style="height: 200px; background: var(--gradient-accent) !important;">
                                <i class="fas fa-newspaper" style="color: white; font-size: 3rem;"></i>
                            </div>
                            @endif
                            <div class="card-body">
                                @if($blog->category)
                                <span class="badge mb-2" style="background: var(--accent-color);">{{ $blog->category }}</span>
                                @endif
                                <h5 class="card-title fw-bold">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none" style="color: var(--primary-color);">
                                        {{ $blog->title }}
                                    </a>
                                </h5>
                                @if($blog->excerpt)
                                <p class="card-text text-muted">{{ Str::limit($blog->excerpt, 120) }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center text-muted small">
                                    <span>
                                        <i class="fas fa-user me-1"></i>{{ $blog->user->name }}
                                    </span>
                                    <span>
                                        <i class="fas fa-calendar me-1"></i>{{ $blog->published_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No blog posts found</h4>
                    </div>
                    @endforelse
                </div>

                @if($blogs->hasPages())
                <div class="mt-5">
                    {{ $blogs->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                @if($categories->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Categories</h5>
                        @foreach($categories as $category)
                        <a href="{{ route('blogs.index', ['category' => $category]) }}" class="d-block mb-2 text-decoration-none">
                            <i class="fas fa-folder me-2" style="color: var(--secondary-color);"></i>{{ $category }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Recent Posts -->
                @if($recent_posts->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Recent Posts</h5>
                        @foreach($recent_posts as $post)
                        <div class="mb-3 pb-3 border-bottom">
                            <a href="{{ route('blogs.show', $post->slug) }}" class="text-decoration-none">
                                <h6 class="small fw-semibold mb-1" style="color: var(--dark-text);">{{ $post->title }}</h6>
                            </a>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $post->published_at->format('M d, Y') }}
                            </small>
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
