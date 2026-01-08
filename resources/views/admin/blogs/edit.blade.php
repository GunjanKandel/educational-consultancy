@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Blogs
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Blog: {{ $blog->title }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $blog->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control"
                           value="{{ old('category', $blog->category) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Featured Image</label>
                    @if($blog->featured_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($blog->featured_image) }}" class="rounded" style="height:60px;">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" value="{{ $blog->user->name ?? '' }}" disabled>
                </div>

                <div class="col-12">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" rows="2" class="form-control">{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Content *</label>
                    <textarea name="content" rows="6" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $blog->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ $blog->is_published ? 'checked' : '' }}>
                    <label class="form-check-label">Published</label>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Blog
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
