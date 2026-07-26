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
                                $pageContent = $content[$activeTab] ?? [];
                                $sectionsOrder = $pageContent['_sections_order'] ?? [];
                            @endphp

                            @if($currentPage)
                                {{-- Header Content Form --}}
                                <form action="{{ route('admin.content.update') }}" method="POST" class="mb-4">
                                    @csrf
                                    <input type="hidden" name="page" value="{{ $activeTab }}">
                                    
                                    @if(isset($currentPage['sections']))
                                    @foreach($currentPage['sections'] as $sectionKey => $section)
                                        <div class="card mb-3">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">{{ $section['name'] }}</h5>
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
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                    
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-save me-1"></i> Save Changes
                                    </button>
                                </form>

                                {{-- Section Order (if available) --}}
                                @if(!empty($currentPage['section_shortcodes']))
                                    @php
                                        $shortcodes = $currentPage['section_shortcodes'];
                                        $order = !empty($sectionsOrder) ? $sectionsOrder : array_keys($shortcodes);
                                    @endphp
                                    
                                    <form action="{{ route('admin.content.updateSectionsOrder') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $activeTab }}">
                                        
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">
                                                    <i class="fa-solid fa-sort me-2"></i>
                                                    Page Sections Order
                                                </h5>
                                                <small class="text-muted">Drag and drop to reorder sections. The order will be reflected on the frontend.</small>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group sortable" id="sortable-sections">
                                                    @foreach($order as $shortcode)
                                                        @if(isset($shortcodes[$shortcode]))
                                                            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $shortcode }}">
                                                                <span>
                                                                    <i class="fa-solid fa-grip-vertical me-2 text-muted"></i>
                                                                    <strong>[{{ $shortcode }}]</strong> - {{ $shortcodes[$shortcode] }}
                                                                </span>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="sections_order" id="sections_order" value="{{ implode(',', $order) }}">
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa-solid fa-save me-1"></i> Save Section Order
                                                </button>
                                            </div>
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
    var el = document.getElementById('sortable-sections');
    if (el) {
        new Sortable(el, {
            animation: 150,
            ghostClass: 'bg-light',
            onEnd: function(evt) {
                var items = el.children;
                var order = [];
                for (var i = 0; i < items.length; i++) {
                    order.push(items[i].getAttribute('data-id'));
                }
                document.getElementById('sections_order').value = order.join(',');
            }
        });
    }
});
</script>
@endsection
