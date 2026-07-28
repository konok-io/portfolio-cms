@extends('front.layouts.app')

@section('seo_title', 'Resume')
@section('meta_description', 'Professional portfolio showcasing skills, experience, and achievements.')

@php
$currentTemplate = request('template') ?? $settings->template ?? 'modern';
$resumeTitle = $pageContent['title'][app()->getLocale()] ?? $pageContent['title']['en'] ?? 'Professional Portfolio';
$resumeSubtitle = $pageContent['subtitle'][app()->getLocale()] ?? $pageContent['subtitle']['en'] ?? 'A comprehensive overview of my skills, experience, and achievements';
@endphp

@section('content')
{{-- Page Header --}}
<section class="page-title-section section-padding">
    <div class="shape-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
        <div class="shape shape-7"></div>
        <div class="shape shape-8"></div>
    </div>

    <div class="container">
        <div class="text-center mb-0">
            <span class="section-eyebrow text-white">{{ $pageContent['eyebrow']['default'] ?? $pageContent['eyebrow']['en'] ?? 'My Resume' }}</span>
            <h1 class="section-title text-white">{{ $resumeTitle }}</h1>
        </div>
    </div>
</section>

{{-- Content Section --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="text-center mb-5">
            <p class="lead text-muted">{{ $resumeSubtitle }}</p>
        </div>

        <!-- Template Selection -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="mb-3">Select Template</h5>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <button onclick="selectTemplate('modern')" type="button"
                               class="btn w-100 template-btn {{ $currentTemplate == 'modern' ? 'active' : '' }}"
                               data-template="modern">
                                <i class="fa-solid fa-grip mb-2 d-block"></i>
                                Modern
                            </button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button onclick="selectTemplate('creative')" type="button"
                               class="btn w-100 template-btn {{ $currentTemplate == 'creative' ? 'active' : '' }}"
                               data-template="creative">
                                <i class="fa-solid fa-palette mb-2 d-block"></i>
                                Creative
                            </button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button onclick="selectTemplate('tech')" type="button"
                               class="btn w-100 template-btn {{ $currentTemplate == 'tech' ? 'active' : '' }}"
                               data-template="tech">
                                <i class="fa-solid fa-code mb-2 d-block"></i>
                                Tech
                            </button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button onclick="selectTemplate('corporate')" type="button"
                               class="btn w-100 template-btn {{ $currentTemplate == 'corporate' ? 'active' : '' }}"
                               data-template="corporate">
                                <i class="fa-solid fa-building mb-2 d-block"></i>
                                Corporate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resume Preview -->
        <div class="resume-preview-wrapper mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <i class="fa-solid fa-eye me-2 text-primary-custom"></i>
                    <span id="templateName">{{ ucfirst($currentTemplate) }} Template Preview</span>
                </h5>
                <a href="{{ route('resume.preview', ['template' => $currentTemplate]) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-external-link-alt me-1"></i>Full Preview
                </a>
            </div>
            <div class="resume-preview-container" style="background: #e5e7eb; padding: 30px; border-radius: 12px;">
                <div class="resume-frame" style="max-width: 210mm; margin: 0 auto; background: white; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
                    <iframe src="{{ route('resume.preview', ['template' => $currentTemplate]) }}" 
                            style="width: 100%; height: 297mm; border: none;" 
                            title="Resume Preview" id="resumeIframe"></iframe>
                </div>
            </div>
        </div>

        <!-- Download Options -->
        <div class="text-center">
            <p class="text-muted mb-3">Like this template? Open it in full screen to download or print.</p>
            <a href="{{ route('resume.preview', ['template' => $currentTemplate]) }}" target="_blank" class="btn btn-primary-custom">
                <i class="fa-solid fa-expand me-2"></i>Open Full Preview
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.template-btn {
    border: 2px solid var(--color-primary);
    color: var(--color-primary);
    background: transparent;
    transition: all 0.3s ease;
}

.template-btn:hover {
    background: rgba(37, 99, 235, 0.1);
}

.template-btn.active {
    background: var(--color-primary);
    color: white;
}

[data-theme="dark"] .template-btn {
    border-color: #3b82f6;
    color: #3b82f6;
}

[data-theme="dark"] .template-btn:hover {
    background: rgba(59, 130, 246, 0.15);
}

[data-theme="dark"] .template-btn.active {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    border-color: transparent;
    color: white;
}
</style>
@endpush

@push('scripts')
<script>
function selectTemplate(template) {
    // Update active button
    document.querySelectorAll('.template-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.template === template) {
            btn.classList.add('active');
        }
    });
    
    // Update iframe src
    const iframe = document.getElementById('resumeIframe');
    const fullPreviewLink = document.querySelector('.resume-preview-wrapper .btn-outline-primary');
    const templateName = document.getElementById('templateName');
    
    iframe.src = '{{ route("resume.preview") }}?template=' + template;
    fullPreviewLink.href = '{{ route("resume.preview") }}?template=' + template;
    templateName.textContent = template.charAt(0).toUpperCase() + template.slice(1) + ' Template Preview';
}
</script>
@endpush
