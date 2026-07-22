@extends('admin.layouts.app')

@section('title', 'Backup Management')

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-database me-2 text-primary"></i>
                Backup Management
            </h1>
            <p class="text-muted small mb-0">Create and manage database backups</p>
        </div>
        <div class="d-flex gap-2">
            @if($backups->isNotEmpty())
                <a href="{{ route('admin.backup.download-all') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-download me-2"></i>Download All
                </a>
            @endif
            <form action="{{ route('admin.backup.create') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary" id="createBackupBtn">
                    <i class="fa-solid fa-plus me-2"></i>Create Backup
                </button>
            </form>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fa-solid fa-hard-drive text-primary fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Storage Used</h6>
                            <h4 class="mb-0">{{ $diskUsed['total'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fa-solid fa-file-circle-check text-success fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Backups</h6>
                            <h4 class="mb-0">{{ $diskUsed['count'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fa-solid fa-folder text-info fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Backup Location</h6>
                            <h6 class="mb-0 text-break" style="font-size: 0.85rem;">storage/app/backups/</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Backup List --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Backup Files</h5>
        </div>
        <div class="card-body p-0">
            @if($backups->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-folder-open text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">No backups found</h5>
                    <p class="text-muted">Click "Create Backup" to generate your first database backup.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 py-3 ps-4">File Name</th>
                                <th class="border-0 py-3">Size</th>
                                <th class="border-0 py-3">Created</th>
                                <th class="border-0 py-3 text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($backups as $backup)
                                <tr>
                                    <td class="ps-4">
                                        <i class="fa-solid fa-file-code text-secondary me-2"></i>
                                        <span class="fw-medium">{{ $backup['filename'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $backup['size_formatted'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $backup['created_formatted'] }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.backup.download', $backup['filename']) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Download">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                            <form action="{{ route('admin.backup.destroy', $backup['filename']) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this backup?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Info Box --}}
    <div class="alert alert-info mt-4 d-flex align-items-start" role="alert">
        <i class="fa-solid fa-info-circle me-3 mt-1"></i>
        <div>
            <strong>Backup Information:</strong>
            <ul class="mb-0 mt-2">
                <li>Backups are stored in <code>storage/app/backups/</code> directory</li>
                <li>Files are compressed using gzip (.gz) for smaller file sizes</li>
                <li>Recommended: Create a backup before making major changes</li>
                <li>Download backups regularly and store them in a safe location</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Loading state for create backup button
    document.getElementById('createBackupBtn')?.addEventListener('click', function() {
        this.disabled = true;
        this.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Creating...';
        this.form.submit();
    });
</script>
@endpush
