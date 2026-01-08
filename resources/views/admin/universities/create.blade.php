@extends('layouts.admin')

@section('title', 'Add University')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.universities.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Universities
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Add University</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.universities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">University Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Country *</label>
                    <select name="country_id" class="form-select" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">World Ranking</label>
                    <input type="number" name="world_ranking" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Partnership Level</label>
                    <input type="text" name="partnership_level" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">University Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control"></textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Create University
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
