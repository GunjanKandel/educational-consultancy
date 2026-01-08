@extends('layouts.admin')

@section('title', 'Contact Inquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Contact Inquiries</h2>
        <p class="text-muted">Manage all contact inquiries</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr class="{{ $contact->status === 'pending' ? 'table-light' : '' }}">
                        <td>
                            <strong>{{ $contact->name }}</strong>
                            @if($contact->status === 'pending')
                            <span class="badge bg-danger badge-sm ms-1">New</span>
                            @endif
                        </td>
                        <td>
                            <small>
                                <i class="fas fa-envelope me-1"></i>{{ $contact->email }}<br>
                                <i class="fas fa-phone me-1"></i>{{ $contact->phone }}
                            </small>
                        </td>
                        <td>{{ $contact->subject ?? 'No subject' }}</td>
                        <td>
                            @if($contact->status === 'replied')
                            <span class="badge bg-success">Replied</span>
                            @elseif($contact->status === 'read')
                            <span class="badge bg-info">Read</span>
                            @else
                            <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                        <td>{{ $contact->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No contact inquiries yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $contacts->links() }}
</div>
@endsection
