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
                                if ($currentPage && isset($currentPage['sections'])) {
                                    $sectionsToShow = $currentPage['sections'];
                                }
                                
                                // Get saved order or default
                                $sectionsOrder = $pageContent['_sections_order'] ?? array_keys($sectionsToShow);
                                $hasMultipleSections = count($sectionsToShow) > 1;
                            @endphp

                            @if($currentPage && !empty($sectionsToShow))
                                @if($hasMultipleSections)
                                <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                                    <i class="fa-solid fa-arrows-up-down-left-right me-2"></i>
                                    <div>
                                        <strong>Drag the grip icon (⋮⋮)</strong> to reorder sections. Click section headers to expand/collapse and edit content.
                                    </div>
                                </div>
                                @endif
                                
                                <form action="{{ route('admin.content.update') }}" method="POST" id="content-form">
                                    @csrf
                                    <input type="hidden" name="page" value="{{ $activeTab }}">
                                    
                                    {{-- Sortable Sections List --}}
                                    <div class="sortable-accordion" id="sortableAccordion">
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
                                                
                                                <div class="accordion-item section-item mb-2" data-section="{{ $sectionKey }}" style="border-radius: 8px; overflow: hidden; border: 1px solid #dee2e6;">
                                                    <div class="section-header d-flex align-items-center bg-light p-3" style="cursor: grab;">
                                                        <i class="fa-solid fa-grip-vertical me-3 text-muted handle" style="cursor: grab;"></i>
                                                        <button class="btn btn-link text-decoration-none flex-grow-1 text-start p-0" 
                                                                type="button" 
                                                                data-bs-toggle="collapse" 
                                                                data-bs-target="#{{ $collapseId }}"
                                                                style="color: inherit;">
                                                            <strong>{{ $sectionName }}</strong>
                                                            @if(isset($section['is_dynamic']) && $section['is_dynamic'] && isset($section['dynamic_type']))
                                                                @php
                                                                    $dynamicType = $section['dynamic_type'];
                                                                    $itemCount = count($dynamicItems[$dynamicType] ?? []);
                                                                @endphp
                                                                <span class="badge bg-primary ms-2">{{ $itemCount }} items</span>
                                                            @else
                                                                <span class="badge bg-secondary ms-2">{{ count($sectionFields) }} fields</span>
                                                            @endif
                                                        </button>
                                                        <i class="fa-solid fa-chevron-down text-muted ms-2 collapse-icon"></i>
                                                    </div>
                                                    <div id="{{ $collapseId }}" 
                                                         class="accordion-collapse collapse {{ $sectionIndex === 1 ? 'show' : '' }}">
                                                        <div class="card-body bg-white">
                                                            @if(!empty($sectionFields))
                                                                @foreach($sectionFields as $fieldIndex => $field)
                                                                    @php
                                                                        $fieldData = $pageContent[$field] ?? [];
                                                                        $enValue = is_array($fieldData) ? ($fieldData['en'] ?? '') : '';
                                                                        $bnValue = is_array($fieldData) ? ($fieldData['bn'] ?? '') : '';
                                                                        $arValue = is_array($fieldData) ? ($fieldData['ar'] ?? '') : '';
                                                                        
                                                                        // Default placeholder values based on field name
                                                                        $fieldLabel = ucwords(str_replace('_', ' ', $field));
                                                                        
                                                                        // Get default values from controller
                                                                        $defaultEn = $defaultValues['en'][$field] ?? ucwords(str_replace('_', ' ', $field));
                                                                        $defaultBn = $defaultValues['bn'][$field] ?? $defaultEn;
                                                                        $defaultAr = $defaultValues['ar'][$field] ?? $defaultEn;
                                                                        
                                                                        // Use saved value or default
                                                                        $enValue = $enValue ?: $defaultEn;
                                                                        $bnValue = $bnValue ?: $defaultBn;
                                                                        $arValue = $arValue ?: $defaultAr;
                                                                        
                                                                        // For dynamic sections, use the actual link title
                                                                        if (isset($section['is_dynamic']) && $section['is_dynamic']) {
                                                                            // Footer quick links
                                                                            if ($activeTab === 'footer' && str_starts_with($field, 'link_')) {
                                                                                $linkNum = (int) substr($field, 5) - 1;
                                                                                if (isset($footerLinks[$linkNum])) {
                                                                                    $fieldLabel = $footerLinks[$linkNum]['title'] ?? $fieldLabel;
                                                                                }
                                                                            }
                                                                            // Header nav menu links
                                                                            if ($activeTab === 'header' && str_starts_with($field, 'nav_link_')) {
                                                                                $linkNum = (int) substr($field, 9) - 1;
                                                                                if (isset($headerNavLinks[$linkNum])) {
                                                                                    $fieldLabel = $headerNavLinks[$linkNum]['title'] ?? $fieldLabel;
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <div class="mb-3">
                                                                        <label class="form-label">
                                                                            <strong>{{ $fieldLabel }}</strong>
                                                                        </label>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="min-width: 80px;"><span class="fi fi-gb"></span> EN</span>
                                                                            <input type="text" name="{{ $field }}_en" class="form-control" value="{{ $enValue }}">
                                                                        </div>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="min-width: 80px;"><span class="fi fi-bd"></span> বাংলা</span>
                                                                            <input type="text" name="{{ $field }}_bn" class="form-control" value="{{ $bnValue }}">
                                                                        </div>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text" style="min-width: 80px;"><span class="fi fi-sa"></span> العربية</span>
                                                                            <input type="text" dir="rtl" name="{{ $field }}_ar" class="form-control" value="{{ $arValue }}">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            
                                                            {{-- Dynamic Items List --}}
                                                            @if(isset($section['is_dynamic']) && $section['is_dynamic'] && isset($section['dynamic_type']))
                                                                @php
                                                                    $dynamicType = $section['dynamic_type'];
                                                                    $items = $dynamicItems[$dynamicType] ?? [];
                                                                    
                                                                    // For nav_menu, use headerNavLinks
                                                                    if ($dynamicType === 'nav_menu') {
                                                                        $items = $headerNavLinks;
                                                                    }
                                                                @endphp
                                                                
                                                                @if(!empty($items))
                                                                    <hr class="my-4">
                                                                    <h6 class="text-uppercase text-muted mb-3">
                                                                        <i class="fa-solid fa-list me-1"></i>
                                                                        {{ $dynamicType === 'nav_menu' ? 'Navigation Menu Items' : ucfirst($dynamicType) }} ({{ count($items) }})
                                                                    </h6>
                                                                    
                                                                    <div class="table-responsive">
                                                                        <table class="table table-sm table-bordered">
                                                                            <thead class="table-light">
                                                                                <tr>
                                                                                    <th width="50">#</th>
                                                                                    <th>Item</th>
                                                                                    <th>Translation</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($items as $itemIndex => $item)
                                                                                    <tr>
                                                                                        <td class="text-center">{{ $itemIndex + 1 }}</td>
                                                                                        <td>
                                                                                            @php
                                                                                                if ($dynamicType === 'nav_menu') {
                                                                                                    $itemName = $item['title'] ?? 'Menu Item ' . ($itemIndex + 1);
                                                                                                    $itemSubtitle = $item['url'] ?? '';
                                                                                                } else {
                                                                                                    $itemName = $item['name'] ?? $item['title'] ?? $item['job_title'] ?? $item['degree'] ?? 'Item ' . ($itemIndex + 1);
                                                                                                    $itemSubtitle = '';
                                                                                                    if (isset($item['company'])) $itemSubtitle = $item['company'];
                                                                                                    if (isset($item['institution'])) $itemSubtitle = $item['institution'];
                                                                                                    if (isset($item['issuer'])) $itemSubtitle = $item['issuer'];
                                                                                                    if (isset($item['category'])) $itemSubtitle = $item['category'];
                                                                                                    if (isset($item['percentage'])) $itemSubtitle = $item['percentage'] . '%';
                                                                                                }
                                                                                            @endphp
                                                                                            <strong>{{ $itemName }}</strong>
                                                                                            @if($itemSubtitle)
                                                                                                <br><small class="text-muted">{{ $itemSubtitle }}</small>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            @php
                                                                                                $itemId = $item['id'] ?? $itemIndex;
                                                                                                $itemContentKey = $dynamicType . '_item_' . $itemId;
                                                                                                $itemContent = $pageContent[$itemContentKey] ?? [];
                                                                                                $hasEn = !empty($itemContent['en'] ?? '');
                                                                                                $hasBn = !empty($itemContent['bn'] ?? '');
                                                                                                $hasAr = !empty($itemContent['ar'] ?? '');
                                                                                            @endphp
                                                                                            <span class="badge bg-{{ $hasEn ? 'success' : 'secondary' }}">EN</span>
                                                                                            <span class="badge bg-{{ $hasBn ? 'success' : 'secondary' }}">BN</span>
                                                                                            <span class="badge bg-{{ $hasAr ? 'success' : 'secondary' }}">AR</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    
                                                                    <div class="alert alert-light border small mt-3">
                                                                        <i class="fa-solid fa-link me-1"></i>
                                                                        Edit from Manager: 
                                                                        @if($dynamicType === 'nav_menu')
                                                                            <a href="{{ route('menu-builder.index') }}">Menu Manager</a>
                                                                        @elseif($dynamicType === 'skills')
                                                                            <a href="{{ route('admin.skills.index') }}">Skills</a>
                                                                        @elseif($dynamicType === 'experience')
                                                                            <a href="{{ route('admin.experience.index') }}">Experience</a>
                                                                        @elseif($dynamicType === 'education')
                                                                            <a href="{{ route('admin.education.index') }}">Education</a>
                                                                        @elseif($dynamicType === 'portfolio')
                                                                            <a href="{{ route('admin.projects.index') }}">Projects</a>
                                                                        @elseif($dynamicType === 'testimonials')
                                                                            <a href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                                                                        @elseif($dynamicType === 'certifications')
                                                                            <a href="{{ route('admin.certifications.index') }}">Certifications</a>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <div class="alert alert-info mt-3">
                                                                        <i class="fa-solid fa-info-circle me-1"></i>
                                                                        No {{ $dynamicType }} found. 
                                                                        @if($dynamicType === 'nav_menu')
                                                                            <a href="{{ route('menu-builder.index') }}">Add Menu Items</a>
                                                                        @elseif($dynamicType === 'skills')
                                                                            <a href="{{ route('admin.skills.index') }}">Add Skills</a>
                                                                        @elseif($dynamicType === 'experience')
                                                                            <a href="{{ route('admin.experience.index') }}">Add Experience</a>
                                                                        @elseif($dynamicType === 'education')
                                                                            <a href="{{ route('admin.education.index') }}">Add Education</a>
                                                                        @elseif($dynamicType === 'portfolio')
                                                                            <a href="{{ route('admin.projects.index') }}">Add Projects</a>
                                                                        @elseif($dynamicType === 'testimonials')
                                                                            <a href="{{ route('admin.testimonials.index') }}">Add Testimonials</a>
                                                                        @elseif($dynamicType === 'certifications')
                                                                            <a href="{{ route('admin.certifications.index') }}">Add Certifications</a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <input type="hidden" name="sections_order" id="sections_order" value="{{ implode(',', $sectionsOrder) }}">
                                    
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.css"/>
<style>
.input-group-text { font-size: 0.85rem; }
.badge-sm { font-size: 0.65rem; padding: 0.2em 0.4em; }
.handle { cursor: grab; }
.handle:active { cursor: grabbing; }
.section-item.sortable-ghost { opacity: 0.4; background: #cfe2ff; }
.section-item.sortable-chosen { background: #e9ecef; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
.section-item.sortable-drag { background: #fff; box-shadow: 0 8px 16px rgba(0,0,0,0.2); opacity: 1; }
.handle { cursor: grab; }
.handle:active { cursor: grabbing; }
.collapse-icon { transition: transform 0.3s; }
.accordion-collapse.show ~ .section-header .collapse-icon,
.section-item:has(.accordion-collapse.show) .collapse-icon { transform: rotate(180deg); }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Bootstrap to be ready
    setTimeout(initSortable, 100);
});

function initSortable() {
    var accordion = document.getElementById('sortableAccordion');
    if (!accordion) {
        console.log('Accordion not found');
        return;
    }
    
    // Destroy existing sortable if any
    if (accordion.dataset.sortableInitialized) {
        return;
    }
    
    var sections = accordion.querySelectorAll('.section-item');
    console.log('Found sections:', sections.length);
    
    // Only enable drag if there are multiple sections
    if (sections.length > 1 && typeof Sortable !== 'undefined') {
        var sortable = new Sortable(accordion, {
            animation: 200,
            handle: '.handle',
            draggable: '.section-item',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            forceFallback: true, // Use fallback for better compatibility
            onEnd: function(evt) {
                console.log('Drag ended');
                updateSectionsOrder();
            }
        });
        
        accordion.dataset.sortableInitialized = 'true';
        console.log('Sortable initialized successfully');
    }
}

function updateSectionsOrder() {
    var accordion = document.getElementById('sortableAccordion');
    if (!accordion) return;
    
    var items = accordion.querySelectorAll('.section-item');
    var order = [];
    for (var i = 0; i < items.length; i++) {
        order.push(items[i].getAttribute('data-section'));
    }
    document.getElementById('sections_order').value = order.join(',');
}
</script>
@endsection
