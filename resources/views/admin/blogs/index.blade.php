@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Blogs</h2>
        <p class="text-muted">Manage all blog posts</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Blog
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td>
                            @if($blog->featured_image)
                                <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}"
                                     class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-newspaper text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $blog->title }}</strong>
                            <br><small class="text-muted">{{ $blog->slug }}</small>
                        </td>
                        <td>{{ $blog->user->name ?? '-' }}</td>
                        <td>{{ $blog->category ?? '-' }}</td>
                        <td>{{ $blog->views }}</td>
                        <td>
                            @if($blog->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-end table-actions">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-3x mb-2"></i>
                            <p>No blogs found. <a href="{{ route('admin.blogs.create') }}">Add your first blog</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $blogs->links() }}
</div>
@endsection
