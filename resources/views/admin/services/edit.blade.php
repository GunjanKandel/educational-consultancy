@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Services
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Service: {{ $service->title }}</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Title -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Service Title *</label>
                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $service->title) }}"
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Icon Class</label>
                    <input type="text"
                           name="icon"
                           class="form-control @error('icon') is-invalid @enderror"
                           value="{{ old('icon', $service->icon) }}"
                           placeholder="e.g., fas fa-concierge-bell">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Order -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Display Order</label>
                    <input type="number"
                           name="order"
                           class="form-control @error('order') is-invalid @enderror"
                           value="{{ old('order', $service->order) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="col-md-8 mb-3">
                    <label class="form-label">Service Image</label>

                    @if($service->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($service->image) }}"
                                 alt="{{ $service->title }}"
                                 class="img-thumbnail"
                                 style="max-height: 150px;">
                        </div>
                    @endif

                    <input type="file"
                           name="image"
                           class="form-control @error('image') is-invalid @enderror"
                           accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-12 mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_active"
                               id="is_active"
                               value="1"
                               {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
