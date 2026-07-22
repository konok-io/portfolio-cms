@extends('admin.layouts.app')

@section('title', 'Content Settings')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Content Settings</h1>
        <p class="admin-breadcrumb mb-0">Manage page content and translations</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="admin-card">
    <div class="mb-4">
        <ul class="nav nav-pills content-tabs" id="contentTabs" role="tablist">
            @foreach($pages as $pageKey => $page)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                            id="{{ $pageKey }}-tab" 
                            data-bs-toggle="pill" 
                            data-bs-target="#{{ $pageKey }}" 
                            type="button" 
                            role="tab">
                        <i class="fa-solid fa-file-lines me-1"></i>
                        {{ $page['name'] }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" id="contentTabsContent">
        @foreach($pages as $pageKey => $page)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                 id="{{ $pageKey }}" 
                 role="tabpanel" 
                 aria-labelledby="{{ $pageKey }}-tab">
                
                <form action="{{ route('admin.content.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="page" value="{{ $pageKey }}">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">{{ $page['name'] }}</h4>
                        <div>
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fa-solid fa-save me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('admin.content.reset', ['page' => $pageKey]) }}" 
                               class="btn btn-outline-secondary"
                               onclick="return confirm('Reset this page to default content?')">
                                <i class="fa-solid fa-rotate-left me-2"></i>Reset
                            </a>
                        </div>
                    </div>

                    @foreach($page['sections'] as $sectionKey => $section)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">{{ $section['name'] }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @foreach($section['fields'] as $field)
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label fw-semibold">
                                                        {{ ucwords(str_replace('_', ' ', $field)) }}
                                                        <small class="text-muted">({{ $field }})</small>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <label class="form-label-admin small text-muted">
                                                        <img src="https://flagcdn.com/16x12/gb.png" class="me-1"> English
                                                    </label>
                                                    <input type="text" 
                                                           name="{{ $field }}_en" 
                                                           class="form-control" 
                                                           value="{{ $content[$pageKey]['default_'.$field] ?? $content[$pageKey][$field.'_en'] ?? $content[$pageKey][$field] ?? '' }}"
                                                           placeholder="English">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label-admin small text-muted">
                                                        <img src="https://flagcdn.com/16x12/bd.png" class="me-1"> বাংলা
                                                    </label>
                                                    <input type="text" 
                                                           name="{{ $field }}_bn" 
                                                           class="form-control" 
                                                           value="{{ $content[$pageKey][$field.'_bn'] ?? '' }}"
                                                           placeholder="বাংলা">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label-admin small text-muted">
                                                        <img src="https://flagcdn.com/16x12/sa.png" class="me-1"> العربية
                                                    </label>
                                                    <input type="text" 
                                                           dir="rtl"
                                                           name="{{ $field }}_ar" 
                                                           class="form-control" 
                                                           value="{{ $content[$pageKey][$field.'_ar'] ?? '' }}"
                                                           placeholder="العربية">
                                                </div>
                                            </div>
                                            <hr class="my-3">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fa-solid fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>

<style>
.content-tabs .nav-link {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    transition: all 0.2s;
}
.content-tabs .nav-link:hover {
    background: var(--color-light);
}
.content-tabs .nav-link.active {
    background: var(--color-primary);
    color: white;
}
</style>
@endsection
