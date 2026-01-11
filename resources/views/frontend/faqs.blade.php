@extends('layouts.frontend')

@section('title', 'FAQs')

@section('content')
<!-- Page Header -->
<section class="hero-section" style="padding: 120px 0 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Frequently Asked Questions</h1>
                <p class="lead mb-0">Find answers to common questions about studying abroad</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQs Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                @forelse($faqs as $category => $categoryFaqs)
                <div class="mb-5">
                    <h3 class="fw-bold mb-4 pb-3 border-bottom" style="color: var(--primary-color);">
                        <i class="fas fa-folder-open me-2"></i>{{ $category }}
                    </h3>
                    <div class="accordion" id="accordion{{ Str::slug($category) }}">
                        @foreach($categoryFaqs as $index => $faq)
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }} fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" style="background: white; color: var(--dark-text);">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#accordion{{ Str::slug($category) }}">
                                <div class="accordion-body text-muted" style="line-height: 1.8;">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="fas fa-question-circle fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No FAQs available</h4>
                </div>
                @endforelse

                <!-- Still Have Questions -->
                <div class="card border-0 shadow-lg mt-5" style="background: var(--gradient-primary); color: white;">
                    <div class="card-body text-center p-5">
                        <h3 class="fw-bold mb-3">Still have questions?</h3>
                        <p class="mb-4">Can't find the answer you're looking for? Please contact our team.</p>
                        <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection