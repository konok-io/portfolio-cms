@extends('front.layouts.app')

@section('seo_title', ($pageContent['title'][app()->getLocale()] ?? $pageContent['title']['en'] ?? 'FAQ') . ' - ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', $pageContent['subtitle'][app()->getLocale()] ?? $pageContent['subtitle']['en'] ?? 'Find answers to frequently asked questions.')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">{{ $pageContent['title'][app()->getLocale()] ?? $pageContent['title']['en'] ?? __('frequently_asked_questions') }}</h1>
                @if($pageContent['subtitle'][app()->getLocale()] ?? $pageContent['subtitle']['en'])
                    <p class="lead text-muted mb-0">{{ $pageContent['subtitle'][app()->getLocale()] ?? $pageContent['subtitle']['en'] }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<x-faq-section :faqs="$faqs" />

@endsection
