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
        <div class="text-center mb-0">
            <h1 class="section-title text-white">
                {{ $customPageContent['title']['default'] ?? $customPageContent['title']['en'] ?? $page->title }}
            </h1>
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
