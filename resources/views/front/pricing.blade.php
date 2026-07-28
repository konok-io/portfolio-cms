@extends('front.layouts.app')

@section('seo_title', ($pageContent['title']['default'] ?? $pageContent['title']['en'] ?? 'Pricing') . ' - ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', $pageContent['subtitle']['default'] ?? $pageContent['subtitle']['en'] ?? 'View our transparent pricing plans.')

@section('content')
<!-- Page Header -->
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
        <div class="row align-items-center mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">{{ $pageContent['title']['default'] ?? $pageContent['title']['en'] ?? 'Pricing' }}</h1>
                @if($pageContent['subtitle']['default'] ?? $pageContent['subtitle']['en'])
                    <p class="lead text-muted mb-0">{{ $pageContent['subtitle']['default'] ?? $pageContent['subtitle']['en'] }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<x-pricing-section :plans="$plans" />

@endsection
