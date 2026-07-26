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
                                        @if(isset($page['is_default_pages']))
                                            <span class="badge bg-secondary float-end">Default</span>
                                        @endif
                                        @if(isset($page['is_custom']))
                                            <span class="badge bg-primary float-end">Custom</span>
                                        @endif
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
                                @if(isset($currentPage['is_default_pages']))
                                    {{-- DEFAULT PAGES: Show pages list with sections order --}}
                                    <div class="default-pages-container">
                                        <ul class="nav nav-tabs mb-3" id="defaultPagesTab" role="tablist">
                                            @foreach($currentPage['sections'] as $sectionKey => $section)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                            id="tab-{{ $sectionKey }}" 
                                                            data-bs-toggle="tab" 
                                                            data-bs-target="#content-{{ $sectionKey }}" 
                                                            type="button" 
                                                            role="tab">
                                                        {{ $section['name'] }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        
                                        <div class="tab-content" id="defaultPagesTabContent">
                                            @foreach($currentPage['sections'] as $sectionKey => $section)
                                                @php
                                                    $pageContent = $content[$section['page_key']] ?? [];
                                                    $sectionsOrder = $pageContent['_sections_order'] ?? array_keys($section['section_shortcodes'] ?? []);
                                                @endphp
                                                
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                                     id="content-{{ $sectionKey }}" 
                                                     role="tabpanel">
                                                    <form action="{{ route('admin.content.update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="page" value="{{ $section['page_key'] }}">
                                                        
                                                        <div class="card mb-3">
                                                            <div class="card-header bg-light">
                                                                <h5 class="mb-0">{{ $section['name'] }} - Header Content</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach($section['fields'] as $field)
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
                                                                        <label class="form-label"><strong>{{ ucwords(str_replace('_', ' ', $field)) }}</strong></label>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="min-width: 80px;"><span class="fi fi-gb"></span> EN</span>
                                                                            <input type="text" name="{{ $field }}_en" class="form-control" value="{{ $enValue }}" placeholder="English">
                                                                        </div>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="min-width: 80px;"><span class="fi fi-bd"></span> বাংলা</span>
                                                                            <input type="text" name="{{ $field }}_bn" class="form-control" value="{{ $bnValue }}" placeholder="বাংলা">
                                                                        </div>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text" style="min-width: 80px;"><span class="fi fi-sa"></span> العربية</span>
                                                                            <input type="text" dir="rtl" name="{{ $field }}_ar" class="form-control" value="{{ $arValue }}" placeholder="العربية">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mt-3">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa-solid fa-save me-1"></i> Save Header Content
                                                            </button>
                                                        </div>
                                                    </form>
                                                    
                                                    @if(!empty($section['section_shortcodes']))
                                                        <form action="{{ route('admin.content.updateSectionsOrder') }}" method="POST" class="mt-4">
                                                            @csrf
                                                            <input type="hidden" name="page" value="{{ $section['page_key'] }}">
                                                            
                                                            <div class="card">
                                                                <div class="card-header bg-light">
                                                                    <h5 class="mb-0">
                                                                        <i class="fa-solid fa-sort me-2"></i>
                                                                        Page Sections Order
                                                                    </h5>
                                                                    <small class="text-muted">Drag and drop to reorder sections. The order will be reflected on the frontend.</small>
                                                                </div>
                                                                <div class="card-body">
                                                                    <ul class="list-group sortable" id="sortable-{{ $sectionKey }}">
                                                                        @foreach($sectionsOrder as $shortcode)
                                                                            @if(isset($section['section_shortcodes'][$shortcode]))
                                                                                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $shortcode }}">
                                                                                    <span>
                                                                                        <i class="fa-solid fa-grip-vertical me-2 text-muted"></i>
                                                                                        <strong>[{{ $shortcode }}]</strong> - {{ $section['section_shortcodes'][$shortcode] }}
                                                                                    </span>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                    <input type="hidden" name="sections_order" id="sections_order_{{ $sectionKey }}" value="{{ implode(',', $sectionsOrder) }}">
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-success">
                                                                        <i class="fa-solid fa-save me-1"></i> Save Section Order
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    {{-- REGULAR PAGES --}}
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<style>
.input-group-text { font-size: 0.85rem; }
.sortable { cursor: move; }
.sortable li:hover { background-color: #f8f9fa; }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.sortable').forEach(function(el) {
        new Sortable(el, {
            animation: 150,
            ghostClass: 'bg-light',
            onEnd: function(evt) {
                const sectionKey = evt.to.id.replace('sortable-', '');
                const items = evt.to.children;
                const order = [];
                items.forEach(function(item) {
                    order.push(item.getAttribute('data-id'));
                });
                document.getElementById('sections_order_' + sectionKey).value = order.join(',');
            }
        });
    });
});
</script>
@endsection
