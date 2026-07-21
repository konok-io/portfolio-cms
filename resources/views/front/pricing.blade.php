@extends('front.layouts.app')

@section('seo_title', 'Pricing - ' . ($siteSetting->site_name ?? 'Portfolio'))

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">{{ __('pricing_plans') }}</h1>
                <p class="lead text-muted mb-0">{{ __('Choose the perfect plan for your needs') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<x-pricing-section :plans="$plans" />

@endsection
