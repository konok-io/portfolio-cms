@extends('front.layouts.app')

@section('seo_title', $page->meta_title ?: $page->title)
@section('seo_description', $page->meta_description)

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
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">
                    {{ $customPageContent['title'][app()->getLocale()] ?? $customPageContent['title']['en'] ?? $page->title }}
                </h1>
                @if(isset($customPageContent['subtitle'][app()->getLocale()]) || isset($customPageContent['subtitle']['en']))
                    <p class="lead text-muted">
                        {{ $customPageContent['subtitle'][app()->getLocale()] ?? $customPageContent['subtitle']['en'] ?? '' }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-{{ $page->template === 'full-width' ? '12' : '8' }}">
                <div class="page-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
