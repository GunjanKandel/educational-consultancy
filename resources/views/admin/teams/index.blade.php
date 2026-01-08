@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Teams</h2>
        <p class="text-muted">Manage team members</p>
    </div>
    <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Team Member
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Designation</th>
                        <th>Expertise</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $team)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($team->photo)
                                        <img src="{{ Storage::url($team->photo) }}"
                                             class="rounded-circle"
                                             style="width:40px;height:40px;object-fit:cover;">
                                    @endif
                                    <div>
                                        <strong>{{ $team->name }}</strong><br>
                                        <small class="text-muted">{{ $team->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $team->designation }}</td>

                            <td>{{ $team->expertise ?? '-' }}</td>

                            <td>{{ $team->order ?? '-' }}</td>

                            <td>
                                @if($team->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.teams.edit', $team) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.teams.destroy', $team) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this team member?')">
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
                                No team members found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $teams->links() }}
</div>
@endsection
