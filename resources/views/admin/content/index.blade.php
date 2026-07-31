@extends('admin.layouts.app')
@section('title', 'Content Settings')
@section('content')
<div class="container-fluid py-4">
    <div class="admin-page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1"><i class="fa-solid fa-pen-to-square me-2"></i>Content Settings</h1>
                <p class="text-muted mb-0">Manage all page content, labels, and text in multiple languages</p>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-0" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-sm py-0" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-list me-2 text-primary"></i>Pages</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush rounded-0">
                        @foreach($pages as $pageKey => $page)
                            <a href="{{ route('admin.content.index', ['tab' => $pageKey]) }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 {{ $activeTab === $pageKey ? 'active' : '' }}">
                                <div class="d-flex align-items-center">
                                    @switch($pageKey)
                                        @case('home')
                                            <i class="fa-solid fa-home me-2 opacity-75"></i>
                                            @break
                                        @case('about')
                                            <i class="fa-solid fa-user me-2 opacity-75"></i>
                                            @break
                                        @case('services')
                                            <i class="fa-solid fa-briefcase me-2 opacity-75"></i>
                                            @break
                                        @case('portfolio')
                                            <i class="fa-solid fa-folder-open me-2 opacity-75"></i>
                                            @break
                                        @case('blog')
                                            <i class="fa-solid fa-blog me-2 opacity-75"></i>
                                            @break
                                        @case('contact')
                                            <i class="fa-solid fa-envelope me-2 opacity-75"></i>
                                            @break
                                        @case('faq')
                                            <i class="fa-solid fa-circle-question me-2 opacity-75"></i>
                                            @break
                                        @case('resume')
                                            <i class="fa-solid fa-file-alt me-2 opacity-75"></i>
                                            @break
                                        @case('pricing')
                                            <i class="fa-solid fa-tag me-2 opacity-75"></i>
                                            @break
                                        @case('footer')
                                            <i class="fa-solid fa-shoe-prints me-2 opacity-75"></i>
                                            @break
                                        @case('search')
                                            <i class="fa-solid fa-magnifying-glass me-2 opacity-75"></i>
                                            @break
                                        @default
                                            <i class="fa-solid fa-file-lines me-2 opacity-75"></i>
                                    @endswitch
                                    <span>{{ $page['name'] }}</span>
                                </div>
                                @if(isset($page['is_custom']))
                                    <span class="badge bg-primary badge-sm">Custom</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
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
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="fa-solid fa-pen-nib me-2 text-primary"></i>{{ $currentPage['name'] }}</h5>
                                        @if($hasMultipleSections)
                                            <span class="badge bg-info"><i class="fa-solid fa-arrows-up-down-left-right me-1"></i> Drag to reorder</span>
                                        @endif
                                    </div>
                                    <div class="card-body p-0">
                                @if($hasMultipleSections)
                                <div class="alert alert-info mb-0 rounded-0" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-lightbulb me-2"></i>
                                        <small><strong>Tip:</strong> Drag the grip icon (⋮⋮) to reorder sections. Click section headers to expand/collapse and edit content.</small>
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
                                                                            <a href="{{ route('admin.menu-builder.index') }}">Menu Manager</a>
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
                                                                            <a href="{{ route('admin.menu-builder.index') }}">Add Menu Items</a>
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
                                    </div>
                                    
                                    <input type="hidden" name="sections_order" id="sections_order" value="{{ implode(',', $sectionsOrder) }}">
                                    
                                    <div class="p-3 bg-light border-top">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa-solid fa-save me-2"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
                            @elseif($currentPage)
                                <div class="alert alert-warning m-3">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                    No content sections configured for this page.
                                </div>
                            @else
                                <div class="alert alert-danger m-3">
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
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
<style>
.input-group-text { font-size: 0.85rem; }
.badge-sm { font-size: 0.65rem; padding: 0.2em 0.4em; }
.handle { color: #6c757d; }
.collapse-icon { transition: transform 0.3s; }
.section-item:has(.accordion-collapse.show) .collapse-icon { transform: rotate(180deg); }
.list-group-item { transition: all 0.2s; }
.list-group-item:hover { transform: translateX(4px); }
.list-group-item.active { font-weight: 600; }
</style>
@endsection

@section('js')
<script>
// All sections are expanded by default
document.addEventListener('DOMContentLoaded', function() {
    // Open all accordions by default
    var accordions = document.querySelectorAll('.accordion-collapse');
    accordions.forEach(function(acc) {
        acc.classList.add('show');
    });
});
</script>
@endsection
