@extends('layouts.admin')

@section('title', 'Add Team Member')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Add Team Member</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Designation</label>
                    <input type="text" name="designation" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Expertise</label>
                    <input type="text" name="expertise" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Facebook</label>
                    <input type="url" name="facebook" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" name="linkedin" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <div class="col-md-6 form-check mt-4">
                    <!-- Hidden input ensures unchecked checkbox sends 0 -->
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Member
                </button>
                <a href="{{ route('admin.teams.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
