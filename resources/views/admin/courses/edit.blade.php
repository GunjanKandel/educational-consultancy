@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Courses
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Course: {{ $course->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $course->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Country *</label>
                    <select name="country_id" class="form-select @error('country_id') is-invalid @enderror" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $course->country_id) == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Duration *</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $course->duration) }}" required>
                    @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Fee</label>
                    <input type="number" step="0.01" name="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee', $course->fee) }}">
                    @error('fee')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Currency</label>
                    <select name="currency" class="form-select">
                        <option value="NPR" {{ old('currency', $course->currency) == 'NPR' ? 'selected' : '' }}>NPR</option>
                        <option value="USD" {{ old('currency', $course->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="EUR" {{ old('currency', $course->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                        <option value="GBP" {{ old('currency', $course->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                        <option value="AUD" {{ old('currency', $course->currency) == 'AUD' ? 'selected' : '' }}>AUD</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Course Image</label>
                    @if($course->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->name }}" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Entry Requirements</label>
                    <textarea name="requirements" rows="4" class="form-control">{{ old('requirements', $course->requirements) }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Featured Course
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $course->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Course
                </button>
            </div>
        </form>
    </div>
</div>
@endsection