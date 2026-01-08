@extends('layouts.admin')

@section('title', 'Edit Scholarship')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Scholarships
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Scholarship: {{ $scholarship->title }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.scholarships.update', $scholarship) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $scholarship->title) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country *</label>
                    <select name="country_id" class="form-select" required>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $scholarship->country_id) == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">University *</label>
                    <select name="university_id" class="form-select" required>
                        @foreach($universities as $university)
                        <option value="{{ $university->id }}" {{ old('university_id', $scholarship->university_id) == $university->id ? 'selected' : '' }}>
                            {{ $university->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $scholarship->amount) }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Currency</label>
                    <select name="currency" class="form-select">
                        <option value="NPR" {{ old('currency', $scholarship->currency) == 'NPR' ? 'selected' : '' }}>NPR</option>
                        <option value="USD" {{ old('currency', $scholarship->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="EUR" {{ old('currency', $scholarship->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                        <option value="GBP" {{ old('currency', $scholarship->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                        <option value="AUD" {{ old('currency', $scholarship->currency) == 'AUD' ? 'selected' : '' }}>AUD</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Application Deadline</label>
                    <input type="date" name="application_deadline" class="form-control" value="{{ old('application_deadline', $scholarship->application_deadline?->format('Y-m-d')) }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $scholarship->description) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Eligibility Criteria</label>
                    <textarea name="eligibility_criteria" rows="3" class="form-control">{{ old('eligibility_criteria', $scholarship->eligibility_criteria) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Required Documents</label>
                    <textarea name="required_documents" rows="3" class="form-control">{{ old('required_documents', $scholarship->required_documents) }}</textarea>
                </div>

                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $scholarship->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Scholarship
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
