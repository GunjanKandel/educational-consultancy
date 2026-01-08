@extends('layouts.admin')

@section('title', 'Edit Country')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.countries.index') }}" class="text-decoration-none text-primary">
        <i class="fas fa-arrow-left me-2"></i>Back to Countries
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4 mb-4">Edit Country: {{ $country->name }}</h1>

        <form action="{{ route('admin.countries.update', $country) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Country Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $country->name) }}" 
                        class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Flag -->
                <div class="col-md-6">
                    <label for="flag" class="form-label">Flag Image</label>
                    @if($country->flag)
                    <div class="mb-2">
                        <img src="{{ Storage::url($country->flag) }}" alt="{{ $country->name }}" class="img-fluid rounded" style="height: 64px; width: 96px; object-fit: cover;">
                    </div>
                    @endif
                    <input type="file" name="flag" id="flag" accept="image/*" 
                        class="form-control @error('flag') is-invalid @enderror">
                    @error('flag')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Display Order -->
                <div class="col-md-6">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $country->order) }}" class="form-control">
                </div>

                <!-- Checkboxes -->
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="form-check mb-2">
                        <input type="checkbox" name="is_popular" id="is_popular" value="1" {{ old('is_popular', $country->is_popular) ? 'checked' : '' }}
                            class="form-check-input">
                        <label for="is_popular" class="form-check-label">Mark as Popular</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $country->is_active) ? 'checked' : '' }}
                            class="form-check-input">
                        <label for="is_active" class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $country->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Benefits -->
            <div class="mt-3">
                <label for="benefits" class="form-label">Why Study Here / Benefits</label>
                <textarea name="benefits" id="benefits" rows="4" class="form-control">{{ old('benefits', $country->benefits) }}</textarea>
            </div>

            <!-- Requirements -->
            <div class="mt-3">
                <label for="requirements" class="form-label">Entry Requirements</label>
                <textarea name="requirements" id="requirements" rows="4" class="form-control">{{ old('requirements', $country->requirements) }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.countries.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Country
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
