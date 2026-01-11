@extends('layouts.admin')

@section('title', 'Add About Topic')

@section('content')
<h1>Add About Topic</h1>

<form action="{{ route('admin.about-topics.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label for="icon" class="form-label">Icon (Font Awesome Class)</label>
        <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon') }}">
        <small class="text-muted">Example: fas fa-bullseye</small>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="order" class="form-label">Order</label>
        <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}" min="0">
        <small class="text-muted">Lower numbers appear first on frontend.</small>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="is_active" id="is_active" value="1" class="form-check-input" {{ old('is_active', 1) ? 'checked' : '' }}>
        <label for="is_active" class="form-check-label">Active</label>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
    <a href="{{ route('admin.about-topics.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
