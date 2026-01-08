@extends('layouts.admin')

@section('title', 'Branches')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Branches</h2>
        <p class="text-muted">Manage all branches</p>
    </div>
    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Branch
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Branch Name</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Main Branch</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branches as $branch)
                        <tr>
                            <td>
                                <strong>{{ $branch->name }}</strong><br>
                                <small class="text-muted">{{ $branch->email }}</small>
                            </td>

                            <td>{{ $branch->city ?? '-' }}</td>

                            <td>{{ $branch->country ?? '-' }}</td>

                            <td>
                                @if($branch->is_main)
                                    <span class="badge bg-info">Main</span>
                                @else
                                    <span class="badge bg-secondary">Sub</span>
                                @endif
                            </td>

                            <td>
                                @if($branch->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.branches.edit', $branch) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.branches.destroy', $branch) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this branch?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No branches found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $branches->links() }}
</div>
@endsection
