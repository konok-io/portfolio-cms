@extends('front.layouts.app')

@section('seo_title', $page->meta_title ?: $page->title)
@section('seo_description', $page->meta_description)

@section('content')
<!-- Page Header -->
<section class="page-header">
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
