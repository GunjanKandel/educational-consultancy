@extends('layouts.admin')

@section('title', 'FAQs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">FAQs</h2>
        <p class="text-muted">Manage all FAQs</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New FAQ
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Views</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $faq->category }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>{{ Str::limit($faq->answer, 50) }}</td>
                    <td>{{ $faq->view_count }}</td>
                    <td>
                        @if($faq->is_featured)
                        <span class="badge bg-warning text-dark"><i class="fas fa-star"></i> Featured</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="text-end table-actions">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
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
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-3x mb-2"></i>
                        <p>No FAQs found. <a href="{{ route('admin.faqs.create') }}">Add your first FAQ</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $faqs->links() }}
</div>
@endsection
