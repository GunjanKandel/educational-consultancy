@extends('layouts.admin')

@section('title', 'Universities')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Universities</h2>
        <p class="text-muted">Manage all universities</p>
    </div>
    <a href="{{ route('admin.universities.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New University
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>University Name</th>
                        <th>Country</th>
                        <th>World Rank</th>
                        <th>Partnership</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($universities as $university)
                    <tr>
                        <!-- Logo -->
                        <td>
                            @if($university->logo)
                                <img src="{{ Storage::url($university->logo) }}"
                                     alt="{{ $university->name }}"
                                     class="rounded"
                                     style="width: 60px; height: 60px; object-fit: contain;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-university text-muted"></i>
                                </div>
                            @endif
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $university->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $university->slug }}</small>
                        </td>

                        <!-- Country -->
                        <td>{{ $university->country->name ?? '-' }}</td>

                        <!-- World Ranking -->
                        <td>
                            @if($university->world_ranking)
                                <strong>#{{ $university->world_ranking }}</strong>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>

                        <!-- Partnership -->
                        <td>
                            <span class="badge 
                                @if($university->partnership_level === 'gold') bg-warning text-dark
                                @elseif($university->partnership_level === 'silver') bg-secondary
                                @else bg-bronze
                                @endif">
                                {{ ucfirst($university->partnership_level) }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            @if($university->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="text-end table-actions">
                            <a href="{{ route('admin.universities.edit', $university) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>

                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('admin.universities.destroy', $university) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this university?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">
                                No universities found.
                                <a href="{{ route('admin.universities.create') }}">Add your first university</a>
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
    {{ $universities->links() }}
</div>
@endsection
