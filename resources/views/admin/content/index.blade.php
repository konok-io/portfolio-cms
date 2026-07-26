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
                                                <div class="row">
                                                    @foreach($section['fields'] as $field)
                                                        @php
                                                            // Get value from flat structure
                                                            $fieldData = $currentContent[$field] ?? null;
                                                            if (is_array($fieldData)) {
                                                                $value = $fieldData['default'] ?? $fieldData['en'] ?? '';
                                                            } else {
                                                                $value = $fieldData ?? '';
                                                            }
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                            <input type="text" 
                                                                   name="{{ $field }}" 
                                                                   class="form-control" 
                                                                   value="{{ $value }}"
                                                                   placeholder="Enter {{ $field }}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
