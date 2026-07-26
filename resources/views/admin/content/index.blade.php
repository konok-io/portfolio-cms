@extends('admin.layouts.app')
@section('title', 'Content Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/tabulator-tables@5/dist/css/tabulator.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Content Settings</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <ul class="nav nav-tabs mb-4" id="pageTabs" role="tablist">
                        @foreach($pages as $pageKey => $page)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                        id="{{ $pageKey }}-tab" 
                                        data-bs-toggle="tab" 
                                        data-bs-target="#{{ $pageKey }}" 
                                        type="button" 
                                        role="tab">
                                    {{ $page['name'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    
                    <form action="{{ route('admin.content.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="page" id="selectedPage" value="{{ array_key_first($pages) }}">
                        
                        <div class="tab-content" id="pageTabsContent">
                            @foreach($pages as $pageKey => $page)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $pageKey }}" role="tabpanel">
                                    @foreach($page['sections'] as $sectionKey => $section)
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ $section['name'] }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($section['fields'] as $field)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                            <input type="text" 
                                                                   name="{{ $pageKey }}_{{ $sectionKey }}_{{ $field }}" 
                                                                   class="form-control" 
                                                                   value="{{ $content->where('key', $pageKey . '.' . $sectionKey . '.' . $field)->first()?->content ?? '' }}"
                                                                   placeholder="Enter {{ $field }}">
                                                            <small class="text-muted">Key: {{ $pageKey }}.{{ $sectionKey }}.{{ $field }}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-1"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.content.reset') }}?page={{ array_key_first($pages) }}" 
                               class="btn btn-outline-secondary ms-2"
                               onclick="return confirm('Are you sure you want to reset this page to default?')">
                                <i class="fa-solid fa-rotate me-1"></i> Reset to Default
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update hidden input when tab changes
    const tabs = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            document.getElementById('selectedPage').value = e.target.getAttribute('data-bs-target').replace('#', '');
        });
    });
    
    // Update reset link when tab changes
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const resetLink = document.querySelector('a[href*="content/reset"]');
            if (resetLink) {
                const page = e.target.getAttribute('data-bs-target').replace('#', '');
                resetLink.href = '{{ route('admin.content.reset') }}?page=' + page;
            }
        });
    });
});
</script>
@endsection
