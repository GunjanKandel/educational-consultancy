@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Appointments</h2>
        <p class="text-muted">Manage all appointments</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Team Member</th>
                    <th>Consultation Type</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appointment->name }}</td>
                    <td>{{ $appointment->email }}</td>
                    <td>{{ $appointment->phone }}</td>
                    <td>{{ $appointment->team->name ?? '-' }}</td>
                    <td>{{ $appointment->consultation_type }}</td>
                    <td>
                        {{ $appointment->appointment_date->format('d M, Y') }}
                        <br>
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                    </td>
                    <td>
                        @php
                            $statusClasses = [
                                'pending' => 'bg-secondary',
                                'confirmed' => 'bg-primary',
                                'completed' => 'bg-success',
                                'cancelled' => 'bg-danger',
                            ];
                        @endphp
                        <span class="badge {{ $statusClasses[$appointment->status] ?? 'bg-secondary' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="text-end table-actions">
                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
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
                    <td colspan="9" class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No appointments found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
