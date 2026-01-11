@extends('layouts.admin')

@section('title', 'Create Branch')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Add New Branch</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.branches.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <!-- NEW ORDER FIELD -->
                <div class="col-md-6">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="1" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Branch Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Google Map URL</label>
                    <input type="url" name="map_url" class="form-control">
                </div>

                <div class="col-md-6 form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="is_main" value="1">
                    <label class="form-check-label">Main Branch</label>
                </div>

                <div class="col-md-6 form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Branch
                </button>
                <a href="{{ route('admin.branches.index') }}" class="btn btn-light">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
