@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Settings</h2>
        <p class="text-muted">Manage your application settings</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div class="row g-3">
                @foreach($settings as $key => $value)
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-capitalize">{{ str_replace('_', ' ', $key) }}</label>
                        <input type="text" 
                               name="{{ $key }}" 
                               class="form-control @error($key) is-invalid @enderror"
                               value="{{ old($key, $value) }}">
                        @error($key)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
