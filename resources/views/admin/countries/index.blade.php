@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Countries</h1>
    <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Country
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Flag</th>
                        <th scope="col">Name</th>
                        <th scope="col">Courses</th>
                        <th scope="col">Popular</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                    <tr>
                        <td>
                            @if($country->flag)
                            <img src="{{ Storage::url($country->flag) }}" alt="{{ $country->name }}" class="rounded" style="height:40px; width:64px; object-fit:cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:64px; height:40px;">
                                <i class="fas fa-flag text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $country->name }}</strong><br>
                            <small class="text-muted">{{ $country->slug }}</small>
                        </td>
                        <td>{{ $country->courses->count() }} courses</td>
                        <td>
                            @if($country->is_popular)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>Popular
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($country->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this country?');">
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
                        <td colspan="6" class="text-center py-4 text-muted">
                            No countries found. <a href="{{ route('admin.countries.create') }}" class="text-decoration-none">Add your first country</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $countries->links() }}
</div>
@endsection
