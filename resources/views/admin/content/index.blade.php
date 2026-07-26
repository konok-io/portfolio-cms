@extends('admin.layouts.app')
@section('title', 'Content Settings')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Content Settings - {{ $pages[$activeTab]['name'] ?? 'Unknown' }}</h3>
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
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $activeTab === $pageKey ? 'active' : '' }}">
                                        <span>{{ $page['name'] }}</span>
                                        @if(isset($page['is_custom']))
                                            <span class="badge bg-primary badge-sm">Custom</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            @php
                                $currentPage = $pages[$activeTab] ?? null;
                                $pageContent = $content[$activeTab] ?? [];
                                
                                // Determine sections to display
                                $sectionsToShow = [];
                                if ($currentPage) {
                                    if (isset($currentPage['sections'])) {
                                        $sectionsToShow = $currentPage['sections'];
                                    }
                                    elseif (isset($currentPage['section_shortcodes'])) {
                                        $sectionsToShow = $currentPage['section_shortcodes'];
                                    }
                                }
                                
                                // Get saved order or default
                                $sectionsOrder = $pageContent['_sections_order'] ?? array_keys($sectionsToShow);
                                $hasMultipleSections = count($sectionsToShow) > 1;
                            @endphp

                            @if($currentPage && !empty($sectionsToShow))
                                <form action="{{ route('admin.content.update') }}" method="POST" id="content-form">
                                    @csrf
                                    <input type="hidden" name="page" value="{{ $activeTab }}">
                                    
                                    {{-- Drag Drop Instructions --}}
                                    @if($hasMultipleSections)
                                    <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                                        <i class="fa-solid fa-arrows-up-down-left-right me-2"></i>
                                        <div>
                                            <strong>Drag the grip icon</strong> to reorder sections. Click section headers to expand/collapse.
                                        </div>
                                    </div>
                                    
                                    {{-- Draggable Section List --}}
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">
                                                <i class="fa-solid fa-sort me-2"></i>
                                                Section Order (Drag to Reorder)
                                            </h5>
                                        </div>
                                        <div class="card-body p-0">
                                            <ul class="list-group sortable-sections" id="sortable-sections" style="margin: 0;">
                                                @foreach($sectionsOrder as $sectionKey)
                                                    @if(isset($sectionsToShow[$sectionKey]))
                                                        @php
                                                            $section = $sectionsToShow[$sectionKey];
                                                            $sectionName = is_array($section) ? ($section['name'] ?? $sectionKey) : $section;
                                                            $sectionFields = is_array($section) ? ($section['fields'] ?? []) : [];
                                                        @endphp
                                                        <li class="list-group-item d-flex justify-content-between align-items-center section-drag-item" data-section="{{ $sectionKey }}">
                                                            <span>
                                                                <i class="fa-solid fa-grip-vertical me-2 text-muted"></i>
                                                                <strong>{{ $sectionName }}</strong>
                                                                <small class="text-muted ms-2">({{ count($sectionFields) }} fields)</small>
                                                            </span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="sections_order" id="sections_order" value="{{ implode(',', $sectionsOrder) }}">
                                        </div>
                                    </div>
                                    @endif
                                    
                                    {{-- Section Content Cards --}}
                                    <div class="{{ $hasMultipleSections ? 'accordion' : '' }}" id="{{ $hasMultipleSections ? 'sectionsAccordion' : 'singleSection' }}">
                                        @php $sectionIndex = 0; @endphp
                                        @foreach($sectionsOrder as $sectionKey)
                                            @if(isset($sectionsToShow[$sectionKey]))
                                                @php
                                                    $section = $sectionsToShow[$sectionKey];
                                                    $sectionName = is_array($section) ? ($section['name'] ?? $sectionKey) : $section;
                                                    $sectionFields = is_array($section) ? ($section['fields'] ?? []) : [];
                                                    $sectionIndex++;
                                                    $collapseId = 'section-' . $sectionIndex;
                                                @endphp
                                                
                                                <div class="section-item {{ $hasMultipleSections ? 'accordion-item' : '' }}" data-section="{{ $sectionKey }}">
                                                    @if($hasMultipleSections)
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button {{ $sectionIndex > 1 ? 'collapsed' : '' }}" 
                                                                type="button" 
                                                                data-bs-toggle="collapse" 
                                                                data-bs-target="#{{ $collapseId }}"
                                                                aria-expanded="{{ $sectionIndex === 1 ? 'true' : 'false' }}">
                                                            <strong>{{ $sectionName }}</strong>
                                                            <span class="badge bg-secondary ms-2">{{ count($sectionFields) }} fields</span>
                                                        </button>
                                                    </h2>
                                                    <div id="{{ $collapseId }}" 
                                                         class="accordion-collapse collapse {{ $sectionIndex === 1 ? 'show' : '' }}" 
                                                         data-bs-parent="#sectionsAccordion">
                                                    @else
                                                    <h5 class="mb-3">
                                                        <i class="fa-solid fa-edit me-2 text-primary"></i>
                                                        {{ $sectionName }}
                                                    </h5>
                                                    @endif
                                                        <div class="card-body">
                                                            @if(!empty($sectionFields))
                                                                @foreach($sectionFields as $field)
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
                                                            @else
                                                                <div class="text-muted">
                                                                    <i class="fa-solid fa-database me-1"></i>
                                                                    This section displays dynamic content from the database.
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @if($hasMultipleSections)
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa-solid fa-save me-1"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
                            @elseif($currentPage)
                                <div class="alert alert-warning">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                    No content sections configured for this page.
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <i class="fa-solid fa-circle-xmark me-2"></i>
                                    Page not found.
                                </div>
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
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #212529;
}
.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
.section-item {
    border: 1px solid rgba(0,0,0,0.125);
    margin-bottom: -1px;
}
.section-item:first-child {
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}
.section-item:last-child {
    border-bottom-left-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
    margin-bottom: 0;
}
.sortable-sections {
    max-height: 300px;
    overflow-y: auto;
}
.section-drag-item {
    transition: background-color 0.2s;
    cursor: grab;
}
.section-drag-item:hover {
    background-color: #f8f9fa;
}
.sortable-ghost {
    opacity: 0.5;
    background-color: #cfe2ff !important;
}
.sortable-chosen {
    background-color: #e9ecef !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.badge-sm {
    font-size: 0.65rem;
    padding: 0.2em 0.4em;
}
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Sortable for the section list
    var el = document.getElementById('sortable-sections');
    var accordion = document.getElementById('sectionsAccordion');
    
    if (el) {
        new Sortable(el, {
            animation: 200,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            handle: '.fa-grip-vertical',
            onEnd: function(evt) {
                updateSectionsOrder();
                reorderAccordion();
            }
        });
    }
    
    function updateSectionsOrder() {
        var items = el.querySelectorAll('.section-drag-item');
        var order = [];
        for (var i = 0; i < items.length; i++) {
            order.push(items[i].getAttribute('data-section'));
        }
        document.getElementById('sections_order').value = order.join(',');
    }
    
    function reorderAccordion() {
        if (!accordion) return;
        var items = el.querySelectorAll('.section-drag-item');
        var accordionItems = accordion.querySelectorAll('.section-item');
        
        items.forEach(function(item) {
            var sectionKey = item.getAttribute('data-section');
            accordionItems.forEach(function(accordionItem) {
                if (accordionItem.getAttribute('data-section') === sectionKey) {
                    accordion.appendChild(accordionItem);
                }
            });
        });
    }
});
</script>
@endsection
