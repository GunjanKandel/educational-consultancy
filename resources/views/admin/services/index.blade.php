@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Services</h2>
        <p class="text-muted">Manage all services</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Service
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 90px;">Image</th>
                        <th>Service</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <!-- Image -->
                        <td>
                            @if($service->image)
                                <img src="{{ Storage::url($service->image) }}"
                                     alt="{{ $service->title }}"
                                     class="rounded"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px;">
                                    <i class="{{ $service->icon ?? 'fas fa-concierge-bell' }} text-muted"></i>
                                </div>
                            @endif
                        </td>

                        <!-- Title -->
                        <td>
                            <strong>{{ $service->title }}</strong>
                            <br>
                            <small class="text-muted">{{ $service->slug }}</small>
                        </td>

                        <!-- Description -->
                        <td>
                            <span class="text-muted">
                                {{ Str::limit(strip_tags($service->description), 60) }}
                            </span>
                        </td>

                        <!-- Order -->
                        <td>
                            <span class="badge bg-secondary">
                                {{ $service->order ?? '—' }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="text-end">
                            <a href="{{ route('admin.services.edit', $service) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>

                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('admin.services.destroy', $service) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">
                                No services found.
                                <a href="{{ route('admin.services.create') }}">Add your first service</a>
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $services->links() }}
</div>
@endsection
