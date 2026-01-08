@extends('layouts.admin')

@section('title', 'Courses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Courses</h2>
        <p class="text-muted">Manage all courses</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Course
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Course Name</th>
                        <th>Country</th>
                        <th>Duration</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td>
                            @if($course->image)
                            <img src="{{ Storage::url($course->image) }}" alt="{{ $course->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-book text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $course->name }}</strong>
                            <br><small class="text-muted">{{ $course->slug }}</small>
                        </td>
                        <td>{{ $course->country->name }}</td>
                        <td>{{ $course->duration }}</td>
                        <td>
                            @if($course->fee)
                                <strong>{{ $course->currency }} {{ number_format($course->fee, 2) }}</strong>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </td>
                        <td>
                            @if($course->is_featured)
                            <span class="badge bg-warning text-dark me-1">
                                <i class="fas fa-star"></i> Featured
                            </span>
                            @endif
                            @if($course->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end table-actions">
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
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
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No courses found. <a href="{{ route('admin.courses.create') }}">Add your first course</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $courses->links() }}
</div>
@endsection