@extends('layouts.admin')

@section('title', 'About Topics')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>About Topics</h1>
    <a href="{{ route('admin.about-topics.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Topic
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Icon</th>
            <th>Order</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($topics as $topic)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $topic->title }}</td>
            <td><i class="{{ $topic->icon }}"></i> {{ $topic->icon }}</td>
            <td>{{ $topic->order }}</td>
            <td>{{ $topic->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.about-topics.edit', $topic->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <form action="{{ route('admin.about-topics.destroy', $topic->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No topics found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
