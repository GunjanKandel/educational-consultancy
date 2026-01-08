@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Testimonials</h2>
        <p class="text-muted">Manage all student testimonials</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Testimonial
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Student Name</th>
                    <th>Country</th>
                    <th>Course</th>
                    <th>University</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                <tr>
                    <td>
                        @if($testimonial->student_photo)
                            <img src="{{ Storage::url($testimonial->student_photo) }}" alt="{{ $testimonial->student_name }}"
                                 class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $testimonial->student_name }}</td>
                    <td>{{ $testimonial->country->name ?? '-' }}</td>
                    <td>{{ $testimonial->course->name ?? '-' }}</td>
                    <td>{{ $testimonial->university }}</td>
                    <td>{{ $testimonial->rating ?? '-' }}</td>
                    <td>
                        @if($testimonial->is_featured)
                            <span class="badge bg-warning text-dark me-1">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                        <span class="badge {{ $testimonial->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="text-end table-actions">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
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
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-3x mb-2"></i>
                        <p>No testimonials found. <a href="{{ route('admin.testimonials.create') }}">Add your first testimonial</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $testimonials->links() }}
</div>
@endsection
