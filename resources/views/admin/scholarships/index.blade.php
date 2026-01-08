@extends('layouts.admin')

@section('title', 'Scholarships')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Scholarships</h2>
        <p class="text-muted">Manage all scholarships</p>
    </div>
    <a href="{{ route('admin.scholarships.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Scholarship
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Country</th>
                    <th>University</th>
                    <th>Amount</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($scholarships as $scholarship)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $scholarship->title }}</td>
                    <td>{{ $scholarship->country->name ?? '-' }}</td>
                    <td>{{ $scholarship->university->name ?? '-' }}</td>
                    <td>{{ $scholarship->currency }} {{ number_format($scholarship->amount, 2) }}</td>
                    <td>{{ $scholarship->application_deadline ? $scholarship->application_deadline->format('Y-m-d') : '-' }}</td>
                    <td>
                        <span class="badge {{ $scholarship->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $scholarship->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($scholarship->isExpired())
                        <span class="badge bg-secondary">Expired</span>
                        @endif
                    </td>
                    <td class="text-end table-actions">
                        <a href="{{ route('admin.scholarships.edit', $scholarship) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <form action="{{ route('admin.scholarships.destroy', $scholarship) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this scholarship?');">
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
                        <p>No scholarships found. <a href="{{ route('admin.scholarships.create') }}">Add your first scholarship</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $scholarships->links() }}
</div>
@endsection
