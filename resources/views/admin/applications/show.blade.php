@extends('layouts.admin')

@section('title', 'Application Details')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Applications
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Application Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Application Number</p>
                        <h6>{{ $application->application_number }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Submission Date</p>
                        <h6>{{ $application->created_at->format('F d, Y h:i A') }}</h6>
                    </div>
                </div>

                <hr>

                <h6 class="text-primary mb-3">Personal Information</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Full Name</p>
                        <p class="fw-bold">{{ $application->full_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Email</p>
                        <p class="fw-bold">{{ $application->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Phone</p>
                        <p class="fw-bold">{{ $application->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Date of Birth</p>
                        <p class="fw-bold">{{ $application->date_of_birth->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Nationality</p>
                        <p class="fw-bold">{{ $application->nationality }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Passport Number</p>
                        <p class="fw-bold">{{ $application->passport_number }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted mb-1">Address</p>
                        <p class="fw-bold">{{ $application->address }}</p>
                    </div>
                </div>

                <hr>

                <h6 class="text-primary mb-3">Academic Information</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Course Applied For</p>
                        <p class="fw-bold">{{ $application->course->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Country</p>
                        <p class="fw-bold">{{ $application->country->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Highest Qualification</p>
                        <p class="fw-bold">{{ $application->highest_qualification }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">GPA/Percentage</p>
                        <p class="fw-bold">{{ $application->gpa_percentage }}%</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">English Test</p>
                        <p class="fw-bold">{{ $application->english_test }}</p>
                    </div>
                    @if($application->english_score)
                    <div class="col-md-6">
                        <p class="text-muted mb-1">English Test Score</p>
                        <p class="fw-bold">{{ $application->english_score }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">Update Status</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.applications.status', $application) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label">Application Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewing" {{ $application->status === 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                            <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="document_required" {{ $application->status === 'document_required' ? 'selected' : '' }}>Documents Required</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Admin Notes</label>
                        <textarea name="admin_notes" rows="4" class="form-control" placeholder="Add notes for the applicant...">{{ $application->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
        <div class="card shadow-sm border-danger">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0">Danger Zone</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash me-2"></i>Delete Application
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection