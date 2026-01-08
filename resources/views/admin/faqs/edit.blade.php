@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to FAQs
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit FAQ: {{ $faq->question }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Category *</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $faq->category) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Question *</label>
                    <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Answer</label>
                    <textarea name="answer" rows="4" class="form-control">{{ old('answer', $faq->answer) }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label">View Count</label>
                    <input type="number" name="view_count" class="form-control" value="{{ old('view_count', $faq->view_count) }}">
                </div>

                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $faq->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
