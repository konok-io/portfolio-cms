@extends('front.layouts.app')

@section('seo_title', 'FAQ - ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', 'Find answers to frequently asked questions about our services, pricing, process, and more. Get the information you need to make informed decisions.')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">{{ __('frequently_asked_questions') }}</h1>
                <p class="lead text-muted mb-0">{{ __('Find answers to common questions about my services and work.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<x-faq-section :faqs="$faqs" />

@endsection
