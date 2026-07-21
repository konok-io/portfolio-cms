@props(['faqs' => collect()])

@if($faqs->count() > 0)
<section class="section bg-light-custom faq-section" id="faq">
    <div class="container">
        <div class="row justify-content-center text-center mb-5" data-aos="fade-up">
            <div class="col-lg-8">
                <span class="eyebrow text-primary mb-3 d-inline-block">{{ __('frequently_asked_questions') }}</span>
                <h2 class="section-title">{{ __('faq') }}</h2>
                <p class="lead text-muted">{{ __('Find answers to common questions about my services, process, and working methodology.') }}</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion faq-accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item border-0 mb-3" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <h3 class="accordion-header">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq-{{ $faq->id }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    <span class="faq-question">{{ $faq->question }}</span>
                                </button>
                            </h3>
                            <div id="faq-{{ $faq->id }}" 
                                 class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p class="mb-0">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.faq-section {
    position: relative;
}

.faq-accordion .accordion-item {
    background: white;
    border-radius: 12px !important;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
}

[data-theme="dark"] .faq-accordion .accordion-item {
    background: #171433;
}

.faq-accordion .accordion-item:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
}

.faq-accordion .accordion-button {
    font-weight: 600;
    color: #1e293b;
    padding: 1.25rem 1.5rem;
    background: transparent;
    box-shadow: none;
}

[data-theme="dark"] .faq-accordion .accordion-button {
    color: #EDECFF;
}

.faq-accordion .accordion-button:not(.collapsed) {
    background: transparent;
    color: #2563eb;
}

.faq-accordion .accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

[data-theme="dark"] .faq-accordion .accordion-button::after {
    filter: brightness(0) invert(1);
}

.faq-accordion .accordion-body {
    padding: 0 1.5rem 1.5rem;
    color: #64748b;
    line-height: 1.7;
}

[data-theme="dark"] .faq-accordion .accordion-body {
    color: #9B98C7;
}

.faq-question {
    flex: 1;
    text-align: left;
}
</style>
@endif
