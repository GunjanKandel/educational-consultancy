@extends('layouts.admin')

@section('title', 'Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Events</h2>
        <p class="text-muted">Manage all events</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Event
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Venue/Link</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>
                        @if($event->featured_image)
                            <img src="{{ Storage::url($event->featured_image) }}" alt="{{ $event->title }}"
                                 class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-calendar-alt text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $event->title }}</strong>
                        <br><small class="text-muted">{{ $event->slug }}</small>
                    </td>
                    <td>{{ ucfirst($event->type) }}</td>
                    <td>{{ $event->event_date?->format('d M Y, h:i A') ?? '-' }}</td>
                    <td>
                        @if($event->online_link)
                            <a href="{{ $event->online_link }}" target="_blank">Online Link</a>
                        @else
                            {{ $event->venue ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $event->capacity ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $event->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $event->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="text-end table-actions">
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this event?');">
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
                        <p>No events found. <a href="{{ route('admin.events.create') }}">Add your first event</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $events->links() }}
</div>
@endsection
