@extends('layouts.admin')

@section('title', 'Edit University')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.universities.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Universities
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit University: {{ $university->name }}</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.universities.update', $university) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">University Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ $university->name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Country *</label>
                    <select name="country_id" class="form-select" required>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ $university->country_id == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">World Ranking</label>
                    <input type="number" name="world_ranking" class="form-control"
                           value="{{ $university->world_ranking }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Partnership Level</label>
                    <input type="text" name="partnership_level" class="form-control"
                           value="{{ $university->partnership_level }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control"
                           value="{{ $university->location }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" class="form-control"
                           value="{{ $university->website }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Logo</label>
                    @if($university->logo)
                        <div class="mb-2">
                            <img src="{{ Storage::url($university->logo) }}"
                                 class="img-thumbnail"
                                 style="max-height: 120px;">
                        </div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ $university->description }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               {{ $university->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.universities.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update University
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
