@extends('layouts.admin')

@section('title', 'Applications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Student Applications</h2>
        <p class="text-muted">Manage all student applications</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Application #</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                    <tr>
                        <td><strong>{{ $application->application_number }}</strong></td>
                        <td>
                            {{ $application->full_name }}
                            <br><small class="text-muted">{{ $application->email }}</small>
                        </td>
                        <td>{{ $application->course->name }}</td>
                        <td>{{ $application->country->name }}</td>
                        <td>
                            @if($application->status === 'approved')
                            <span class="badge bg-success">Approved</span>
                            @elseif($application->status === 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                            @elseif($application->status === 'reviewing')
                            <span class="badge bg-info">Reviewing</span>
                            @elseif($application->status === 'document_required')
                            <span class="badge bg-warning text-dark">Documents Required</span>
                            @else
                            <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                        <td>{{ $application->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.applications.show', $application) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No applications yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $applications->links() }}
</div>
@endsection