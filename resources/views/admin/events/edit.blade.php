@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Events
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Event: {{ $event->title }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Event Type *</label>
                    <select name="type" class="form-select" required>
                        <option value="online" {{ old('type', $event->type)=='online'?'selected':'' }}>Online</option>
                        <option value="offline" {{ old('type', $event->type)=='offline'?'selected':'' }}>Offline</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Event Date *</label>
                    <input type="datetime-local" name="event_date" class="form-control" value="{{ old('event_date', $event->event_date?->format('Y-m-d\TH:i')) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Venue</label>
                    <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Online Link</label>
                    <input type="url" name="online_link" class="form-control" value="{{ old('online_link', $event->online_link) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Capacity</label>
                    <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $event->capacity) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Registered</label>
                    <input type="number" name="registered" class="form-control" value="{{ old('registered', $event->registered) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Featured Image</label>
                    @if($event->featured_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($event->featured_image) }}" class="rounded" style="width:60px; height:60px; object-fit:cover;">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
