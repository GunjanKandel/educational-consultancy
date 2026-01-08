@extends('layouts.admin')

@section('title', 'Edit Branch')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Edit Branch</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.branches.update', $branch) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Branch Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ $branch->name }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ $branch->phone }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $branch->email }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control"
                           value="{{ $branch->city }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control"
                           value="{{ $branch->state }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control"
                           value="{{ $branch->country }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" rows="3"
                              class="form-control">{{ $branch->address }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Google Map URL</label>
                    <input type="url" name="map_url" class="form-control"
                           value="{{ $branch->map_url }}">
                </div>

                <div class="col-md-6 form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="is_main"
                           value="1" {{ $branch->is_main ? 'checked' : '' }}>
                    <label class="form-check-label">Main Branch</label>
                </div>

                <div class="col-md-6 form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="is_active"
                           value="1" {{ $branch->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Branch
                </button>
                <a href="{{ route('admin.branches.index') }}" class="btn btn-light">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
