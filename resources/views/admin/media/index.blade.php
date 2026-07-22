@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('content')

<div class="admin-page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Media Library</h1>
            <p class="admin-breadcrumb mb-0">Manage your uploaded files.</p>
        </div>
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fa-solid fa-upload me-2"></i>Upload Files
        </button>
    </div>
</div>

{{-- Filters --}}
<div class="admin-card mb-3">
    <div class="card-body-custom">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search files..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="image" {{ request('type') === 'image' ? 'selected' : '' }}>Images</option>
                    <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>Videos</option>
                    <option value="document" {{ request('type') === 'document' ? 'selected' : '' }}>Documents</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-admin-secondary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<x-validation-errors />
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Media Grid --}}
@if($media->isEmpty())
    <div class="admin-card text-center py-5">
        <div class="card-body-custom">
            <i class="fa-solid fa-images fa-3x text-muted mb-3"></i>
            <p class="text-muted">No media files found.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                Upload your first file
            </button>
        </div>
    </div>
@else
    <div class="row g-3">
        @foreach($media as $item)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="admin-card h-100 media-item">
                    <div class="media-preview">
                        @if(str_starts_with($item->mime_type, 'image/'))
                            <img src="{{ $item->url }}" alt="{{ $item->alt_text ?? $item->name }}" class="img-fluid">
                        @else
                            <div class="text-center py-4">
                                <i class="{{ $item->type_icon }} fa-3x text-muted"></i>
                                <p class="small text-muted mt-2 mb-0">{{ $item->mime_type }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-body-custom py-2">
                        <p class="small mb-1 text-truncate" title="{{ $item->name }}">{{ $item->name }}</p>
                        <p class="small text-muted mb-2">{{ $item->size_formatted }}</p>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-sm btn-outline-secondary flex-grow-1" onclick="copyUrl('{{ $item->url }}')">
                                <i class="fa-solid fa-copy"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.media.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Delete this file?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.media.update', $item) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Media</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if(str_starts_with($item->mime_type, 'image/'))
                                    <img src="{{ $item->url }}" alt="{{ $item->alt_text ?? $item->name }}" class="img-fluid mb-3 rounded">
                                @endif
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alt Text</label>
                                    <input type="text" name="alt_text" class="form-control" value="{{ $item->alt_text }}" placeholder="Image description for accessibility">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Caption</label>
                                    <textarea name="caption" class="form-control" rows="2">{{ $item->caption }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $media->withQueryString()->links() }}
    </div>
@endif

{{-- Upload Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Files</label>
                        <input type="file" name="files[]" class="form-control" multiple accept="image/*,video/*,application/pdf" id="fileInput">
                        <small class="text-muted d-block mt-2">Max file size: 10MB. Supported: JPG, PNG, GIF, WEBP, PDF, MP4</small>
                    </div>
                    <div id="previewFiles" class="d-flex flex-wrap gap-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn">
                        <i class="fa-solid fa-upload me-2"></i>Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function copyUrl(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert('URL copied to clipboard!');
    });
}

document.getElementById('fileInput')?.addEventListener('change', function(e) {
    const preview = document.getElementById('previewFiles');
    preview.innerHTML = '';
    
    Array.from(e.target.files).forEach(file => {
        const div = document.createElement('div');
        div.className = 'border rounded p-2';
        div.style.width = '100px';
        div.style.textAlign = 'center';
        
        if (file.type.startsWith('image/')) {
            div.innerHTML = `<img src="${URL.createObjectURL(file)}" style="width:100%;height:60px;object-fit:cover;" class="mb-1 rounded">`;
        } else {
            div.innerHTML = `<i class="fa-solid fa-file fa-2x mb-1"></i>`;
        }
        div.innerHTML += `<p class="small mb-0 text-truncate" style="font-size:10px;">${file.name}</p>`;
        
        preview.appendChild(div);
    });
});
</script>
@endpush

@push('styles')
<style>
.media-item {
    transition: transform 0.2s;
}
.media-item:hover {
    transform: translateY(-2px);
}
.media-preview {
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 8px 8px 0 0;
    overflow: hidden;
}
[data-theme="dark"] .media-preview {
    background: #12102E;
}
.media-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
@endpush
