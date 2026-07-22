@extends('front.layouts.app')

@section('title', 'Resume - ' . ($siteSetting->site_name ?? 'Portfolio'))

@php
$currentTemplate = request('template') ?? $settings->template ?? 'modern';
@endphp

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">My Resume</span>
            <h1 class="section-title">Professional Portfolio</h1>
            <p class="text-muted">A comprehensive overview of my skills, experience, and achievements</p>
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
    border-color: #8B7BF4;
    color: #8B7BF4;
}

[data-theme="dark"] .template-btn:hover {
    background: rgba(139, 123, 244, 0.15);
}

[data-theme="dark"] .template-btn.active {
    background: linear-gradient(135deg, #4F2FE8, #22D3EE);
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
