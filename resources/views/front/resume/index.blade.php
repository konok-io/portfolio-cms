@extends('front.layouts.app')

@section('title', 'Resume - ' . ($siteSetting->site_name ?? 'Portfolio'))

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
                            <a href="{{ route('resume.preview', ['template' => 'modern']) }}" 
                               class="btn btn-outline-primary w-100 {{ ($settings->template ?? 'modern') == 'modern' ? 'active' : '' }}"
                               style="{{ ($settings->template ?? 'modern') == 'modern' ? 'background: var(--color-primary); color: white;' : '' }}">
                                <i class="fa-solid fa-grip mb-2 d-block"></i>
                                Modern
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('resume.preview', ['template' => 'creative']) }}" 
                               class="btn btn-outline-primary w-100 {{ $settings->template == 'creative' ? 'active' : '' }}"
                               style="{{ $settings->template == 'creative' ? 'background: var(--color-primary); color: white;' : '' }}">
                                <i class="fa-solid fa-palette mb-2 d-block"></i>
                                Creative
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('resume.preview', ['template' => 'tech']) }}" 
                               class="btn btn-outline-primary w-100 {{ $settings->template == 'tech' ? 'active' : '' }}"
                               style="{{ $settings->template == 'tech' ? 'background: var(--color-primary); color: white;' : '' }}">
                                <i class="fa-solid fa-code mb-2 d-block"></i>
                                Tech
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('resume.preview', ['template' => 'corporate']) }}" 
                               class="btn btn-outline-primary w-100 {{ $settings->template == 'corporate' ? 'active' : '' }}"
                               style="{{ $settings->template == 'corporate' ? 'background: var(--color-primary); color: white;' : '' }}">
                                <i class="fa-solid fa-building mb-2 d-block"></i>
                                Corporate
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resume Preview -->
        <div class="resume-preview-wrapper mb-5">
            <div class="text-center mb-4">
                <h5>Preview</h5>
            </div>
            <div class="resume-preview-container" style="background: #e5e7eb; padding: 30px; border-radius: 12px;">
                <div class="resume-frame" style="max-width: 210mm; margin: 0 auto; background: white; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
                    <iframe src="{{ route('resume.preview') }}" 
                            style="width: 100%; height: 297mm; border: none;" 
                            title="Resume Preview"></iframe>
                </div>
            </div>
        </div>

        <!-- Download Options -->
        <div class="text-center">
            <p class="text-muted mb-3">Want a downloadable version? Use the preview page.</p>
            <a href="{{ route('resume.preview') }}" target="_blank" class="btn btn-primary-custom">
                <i class="fa-solid fa-expand me-2"></i>Open Full Preview
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.resume-preview-container iframe {
    max-height: 100vh;
}
</style>
@endpush
