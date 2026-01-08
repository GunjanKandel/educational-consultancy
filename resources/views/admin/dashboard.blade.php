@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h2 class="mb-0">Dashboard</h2>
    <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Courses</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_courses'] }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-book text-primary fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Countries</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_countries'] }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-globe text-success fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Applications</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_applications'] }}</h3>
                        <small class="text-warning">{{ $stats['pending_applications'] }} pending</small>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-file-alt text-warning fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Contact Inquiries</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_contacts'] }}</h3>
                        <small class="text-danger">{{ $stats['unread_contacts'] }} unread</small>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-envelope text-danger fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Published Blogs</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['published_blogs'] }}</h3>
                        <small class="text-muted">of {{ $stats['total_blogs'] }} total</small>
                    </div>
                    <div class="bg-purple bg-opacity-10 rounded-circle p-3" style="background-color: rgba(128, 0, 128, 0.1) !important;">
                        <i class="fas fa-blog fa-2x" style="color: #800080;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Testimonials</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_testimonials'] }}</h3>
                    </div>
                    <div class="rounded-circle p-3" style="background-color: rgba(255, 193, 7, 0.1);">
                        <i class="fas fa-star fa-2x" style="color: #ffc107;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Applications -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 fw-bold">Recent Applications</h5>
            </div>
            <div class="card-body">
                @forelse($recent_applications as $application)
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">{{ $application->full_name }}</p>
                        <p class="mb-1 text-muted small">{{ $application->course->name }}</p>
                        <p class="mb-0 text-muted" style="font-size: 0.75rem;">{{ $application->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="badge 
                        @if($application->status === 'approved') bg-success
                        @elseif($application->status === 'rejected') bg-danger
                        @elseif($application->status === 'reviewing') bg-info
                        @else bg-secondary
                        @endif">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                @empty
                <p class="text-muted text-center py-4 mb-0">No applications yet</p>
                @endforelse
                
                @if($recent_applications->count() > 0)
                <div class="mt-3">
                    <a href="{{ route('admin.applications.index') }}" class="text-primary text-decoration-none small">
                        View all applications <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 fw-bold">Recent Contact Inquiries</h5>
            </div>
            <div class="card-body">
                @forelse($recent_contacts as $contact)
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">{{ $contact->name }}</p>
                        <p class="mb-1 text-muted small">{{ Str::limit($contact->message, 50) }}</p>
                        <p class="mb-0 text-muted" style="font-size: 0.75rem;">{{ $contact->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="badge 
                        @if($contact->status === 'replied') bg-success
                        @elseif($contact->status === 'read') bg-info
                        @else bg-secondary
                        @endif">
                        {{ ucfirst($contact->status) }}
                    </span>
                </div>
                @empty
                <p class="text-muted text-center py-4 mb-0">No contact inquiries yet</p>
                @endforelse
                
                @if($recent_contacts->count() > 0)
                <div class="mt-3">
                    <a href="{{ route('admin.contacts.index') }}" class="text-primary text-decoration-none small">
                        View all contacts <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection