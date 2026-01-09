@extends('layouts.frontend')

@section('title', 'Application Submitted')

@section('content')
<section class="py-5" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle fa-5x" style="color: var(--accent-color);"></i>
                        </div>
                        <h2 class="fw-bold mb-3" style="color: var(--primary-color);">Application Submitted Successfully!</h2>
                        <p class="text-muted mb-4">Thank you for applying. We have received your application.</p>
                        
                        <div class="alert alert-info mb-4">
                            <strong>Your Application Number:</strong><br>
                            <h3 class="mb-0" style="color: var(--secondary-color);">{{ $application_number }}</h3>
                        </div>

                        <p class="text-muted">Please save this number for future reference. You will receive a confirmation email shortly.</p>

                        <div class="d-flex gap-3 justify-content-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                                <i class="fas fa-home me-2"></i>Back to Home
                            </a>
                            <a href="{{ route('courses.index') }}" class="btn btn-primary">
                                <i class="fas fa-book me-2"></i>Browse More Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection