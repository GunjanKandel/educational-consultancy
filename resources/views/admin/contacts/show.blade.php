@extends('layouts.admin')

@section('title', 'Contact Inquiry Details')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Contacts
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Contact Inquiry Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Name</p>
                        <h6>{{ $contact->name }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Date</p>
                        <h6>{{ $contact->created_at->format('F d, Y h:i A') }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Email</p>
                        <h6>{{ $contact->email }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Phone</p>
                        <h6>{{ $contact->phone }}</h6>
                    </div>
                    @if($contact->subject)
                    <div class="col-md-12">
                        <p class="text-muted mb-1">Subject</p>
                        <h6>{{ $contact->subject }}</h6>
                    </div>
                    @endif
                </div>

                <hr>

                <h6 class="text-primary mb-2">Message</h6>
                <div class="p-3 bg-light rounded">
                    <p class="mb-0">{{ $contact->message }}</p>
                </div>

                @if($contact->admin_reply)
                <hr>
                <h6 class="text-success mb-2">Your Reply</h6>
                <div class="p-3 bg-success bg-opacity-10 rounded">
                    <p class="mb-0">{{ $contact->admin_reply }}</p>
                    <small class="text-muted">Replied on: {{ $contact->replied_at->format('F d, Y h:i A') }}</small>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0">Send Reply</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Your Reply</label>
                        <textarea name="admin_reply" rows="6" class="form-control" placeholder="Type your reply here..." required>{{ $contact->admin_reply }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-paper-plane me-2"></i>Send Reply
                    </button>
                </form>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
        <div class="card shadow-sm border-danger">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0">Danger Zone</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash me-2"></i>Delete Inquiry
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection