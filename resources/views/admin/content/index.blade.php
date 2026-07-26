@extends('admin.layouts.app')
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
                                    <a href="{{ route('admin.content.index', ['tab' => $pageKey]) }}"
                                       class="list-group-item list-group-item-action {{ $activeTab === $pageKey ? 'active' : '' }}">
                                        {{ $page['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            @php
                                $currentPage = $pages[$activeTab] ?? null;
                                $currentContent = $content[$activeTab] ?? [];
                            @endphp

                            @if($currentPage)
                                <form action="{{ route('admin.content.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="page" value="{{ $activeTab }}">

                                    @foreach($currentPage['sections'] as $sectionKey => $section)
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ $section['name'] }}</h5>
                                            </div>
                                            <div class="card-body">
                                                @foreach($section['fields'] as $field)
                                                    @php
                                                        $fieldData = $currentContent[$field] ?? [];
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
