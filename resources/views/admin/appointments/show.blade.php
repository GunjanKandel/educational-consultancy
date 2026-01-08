@extends('layouts.admin')

@section('title', 'View Appointment')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Appointments
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Appointment Details</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Client Name:</strong> {{ $appointment->name }}
            </div>
            <div class="col-md-6">
                <strong>Email:</strong> {{ $appointment->email }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Phone:</strong> {{ $appointment->phone }}
            </div>
            <div class="col-md-6">
                <strong>Team Member:</strong> {{ $appointment->team->name ?? '-' }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Consultation Type:</strong> {{ $appointment->consultation_type }}
            </div>
            <div class="col-md-6">
                <strong>Date & Time:</strong> 
                {{ $appointment->appointment_date->format('d M, Y') }} 
                at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Status:</strong> 
                <span class="badge {{ [
                    'pending'=>'bg-secondary',
                    'confirmed'=>'bg-primary',
                    'completed'=>'bg-success',
                    'cancelled'=>'bg-danger'
                ][$appointment->status] ?? 'bg-secondary' }}">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>
            <div class="col-md-6">
                <strong>Message:</strong>
                <p>{{ $appointment->message ?? '-' }}</p>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
        <form action="{{ route('admin.appointments.updateStatus', $appointment) }}" method="POST" class="mt-3">
            @csrf
            @method('PATCH')
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label for="status" class="form-label">Update Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="pending" {{ $appointment->status=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $appointment->status=='completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $appointment->status=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
