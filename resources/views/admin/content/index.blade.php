@extends('admin.layouts.app')

@php
use App\Models\CustomPage;
@endphp

@section('title', 'Content Settings')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Content Settings</h3>
                    @if(session('success'))
                        <span class="badge bg-success">{{ session('success') }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group">
                                @foreach($pages as $pageKey => $page)
                                    @if($pageKey !== 'custom_pages' || ($pageKey === 'custom_pages' && !empty($page['sections'])))
                                        <a href="{{ route('admin.content.index', ['tab' => $pageKey]) }}"
                                           class="list-group-item list-group-item-action {{ $activeTab === $pageKey ? 'active' : '' }}">
                                            {{ $page['name'] }}
                                            @if($pageKey === 'custom_pages')
                                                <span class="badge bg-info float-end">{{ count($page['sections'] ?? []) }}</span>
                                            @endif
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            @php
                                $currentPage = $pages[$activeTab] ?? null;
                            @endphp

                            @if($currentPage)
                                @if($activeTab === 'custom_pages')
                                    {{-- Custom Pages: Each section is a separate form --}}
                                    @php
                                        $customPagesList = CustomPage::orderBy('sort_order')->get();
                                    @endphp
                                    
                                    @forelse($customPagesList as $customPageItem)
                                        @php
                                            $pageKey = 'custom_' . $customPageItem->id;
                                            $sectionData = $currentPage['sections'][$pageKey] ?? null;
                                            $pageContent = $content[$pageKey] ?? [];
                                        @endphp
                                        
                                        @if($sectionData)
                                            <form action="{{ route('admin.content.update') }}" method="POST" class="mb-4">
                                                @csrf
                                                <input type="hidden" name="page" value="{{ $pageKey }}">
                                                
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                                        <h5 class="mb-0">
                                                            <i class="fa-solid fa-file-lines me-2"></i>
                                                            {{ $customPageItem->title }}
                                                            @if(!$customPageItem->is_published)
                                                                <span class="badge bg-secondary ms-2">Draft</span>
                                                            @endif
                                                        </h5>
                                                        <a href="{{ route('admin.custom-pages.edit', $customPageItem->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fa-solid fa-edit"></i> Edit Page
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach($sectionData['fields'] as $field)
                                                            @php
                                                                $fieldData = $pageContent[$field] ?? [];
                                                                $enValue = is_array($fieldData) ? ($fieldData['en'] ?? '') : '';
                                                                $bnValue = is_array($fieldData) ? ($fieldData['bn'] ?? '') : '';
                                                                $arValue = is_array($fieldData) ? ($fieldData['ar'] ?? '') : '';
                                                                if (empty($enValue) && !is_array($fieldData)) {
                                                                    $enValue = $fieldData;
                                                                    $bnValue = $fieldData;
                                                                    $arValue = $fieldData;
                                                                }
                                                            @endphp
                                                            <div class="mb-3">
                                                                <label class="form-label">
                                                                    <strong>{{ ucwords(str_replace('_', ' ', $field)) }}</strong>
                                                                </label>
                                                                
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text" style="min-width: 80px;">
                                                                        <span class="fi fi-gb"></span> EN
                                                                    </span>
                                                                    <input type="text" name="{{ $field }}_en" class="form-control" value="{{ $enValue }}" placeholder="English">
                                                                </div>
                                                                
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text" style="min-width: 80px;">
                                                                        <span class="fi fi-bd"></span> বাংলা
                                                                    </span>
                                                                    <input type="text" name="{{ $field }}_bn" class="form-control" value="{{ $bnValue }}" placeholder="বাংলা">
                                                                </div>
                                                                
                                                                <div class="input-group">
                                                                    <span class="input-group-text" style="min-width: 80px;">
                                                                        <span class="fi fi-sa"></span> العربية
                                                                    </span>
                                                                    <input type="text" dir="rtl" name="{{ $field }}_ar" class="form-control" value="{{ $arValue }}" placeholder="العربية">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa-solid fa-save me-1"></i> Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @empty
                                        <div class="alert alert-info">
                                            No custom pages found. <a href="{{ route('admin.custom-pages.create') }}">Create one</a>
                                        </div>
                                    @endforelse
                                @else
                                    {{-- Regular pages: Single form for all sections --}}
                                    <form action="{{ route('admin.content.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $activeTab }}">

                                        @foreach($currentPage['sections'] as $sectionKey => $section)
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <h5 class="mb-0">{{ $section['name'] }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($section['fields'] as $field)
                                                            @php
                                                                $fieldData = $content[$activeTab][$field] ?? [];
                                                                $enValue = is_array($fieldData) ? ($fieldData['en'] ?? '') : '';
                                                                $bnValue = is_array($fieldData) ? ($fieldData['bn'] ?? '') : '';
                                                                $arValue = is_array($fieldData) ? ($fieldData['ar'] ?? '') : '';
                                                                if (empty($enValue) && !is_array($fieldData)) {
                                                                    $enValue = $fieldData;
                                                                    $bnValue = $fieldData;
                                                                    $arValue = $fieldData;
                                                                }
                                                            @endphp
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label">
                                                                    <strong>{{ ucwords(str_replace('_', ' ', $field)) }}</strong>
                                                                </label>
                                                                
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text" style="min-width: 80px;">
                                                                        <span class="fi fi-gb"></span> EN
                                                                    </span>
                                                                    <input type="text" name="{{ $field }}_en" class="form-control" value="{{ $enValue }}" placeholder="English">
                                                                </div>
                                                                
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text" style="min-width: 80px;">
                                                                        <span class="fi fi-bd"></span> বাংলা
                                                                    </span>
                                                                    <input type="text" name="{{ $field }}_bn" class="form-control" value="{{ $bnValue }}" placeholder="বাংলা">
                                                                </div>
                                                                
                                                                <div class="input-group">
                                                                    <span class="input-group-text" style="min-width: 80px;">
                                                                        <span class="fi fi-sa"></span> العربية
                                                                    </span>
                                                                    <input type="text" dir="rtl" name="{{ $field }}_ar" class="form-control" value="{{ $arValue }}" placeholder="العربية">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-save me-1"></i> Save Changes
                                            </button>
                                            <a href="{{ route('admin.content.reset') }}?page={{ $activeTab }}"
                                               class="btn btn-outline-secondary ms-2"
                                               onclick="return confirm('Are you sure you want to reset this page to default?')">
                                                <i class="fa-solid fa-rotate me-1"></i> Reset to Default
                                            </a>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
<style>
.input-group-text {
    font-size: 0.85rem;
}
</style>
@endsection
