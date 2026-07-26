@extends('admin.layouts.app')
@section('title', 'Menu Builder')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fa-solid fa-bars me-2"></i>Menu Builder</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                        <i class="fa-solid fa-plus me-1"></i> Add Menu Item
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#header-menu" type="button">
                                <i class="fa-solid fa-heading me-1"></i> Header Menu
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#footer-menu" type="button">
                                <i class="fa-solid fa-shoe-prints me-1"></i> Footer Menu
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <!-- Header Menu Tab -->
                        <div class="tab-pane fade show active" id="header-menu">
                            @php($headerItems = $menuItems->where('menu_type', 'header'))
                            @if($headerItems->isEmpty())
                                <div class="text-center py-4">
                                    <i class="fa-solid fa-heading text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2 text-muted">No header menu items.</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="60">Order</th>
                                                <th>Name</th>
                                                <th>Route</th>
                                                <th>Icon</th>
                                                <th>Status</th>
                                                <th width="120">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($headerItems->sortBy('order') as $item)
                                                <tr class="{{ !$item->is_active ? 'text-muted opacity-50' : '' }}">
                                                    <td>{{ $item->order }}</td>
                                                    <td><strong>{{ $item->name }}</strong></td>
                                                    <td><code class="small">{{ $item->route ?? $item->url ?? '-' }}</code></td>
                                                    <td>@if($item->icon)<i class="{{ $item->icon }}"></i>@else-@endif</td>
                                                    <td>
                                                        <form action="{{ route('admin.menu-builder.toggle', $item) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.menu-builder.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @include('admin.menu-builder.partials.edit-modal', ['item' => $item])
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Footer Menu Tab -->
                        <div class="tab-pane fade" id="footer-menu">
                            @php($footerItems = $menuItems->where('menu_type', 'footer'))
                            @if($footerItems->isEmpty())
                                <div class="text-center py-4">
                                    <i class="fa-solid fa-shoe-prints text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2 text-muted">No footer menu items.</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="60">Order</th>
                                                <th>Name</th>
                                                <th>Route</th>
                                                <th>Icon</th>
                                                <th>Status</th>
                                                <th width="120">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($footerItems->sortBy('order') as $item)
                                                <tr class="{{ !$item->is_active ? 'text-muted opacity-50' : '' }}">
                                                    <td>{{ $item->order }}</td>
                                                    <td><strong>{{ $item->name }}</strong></td>
                                                    <td><code class="small">{{ $item->route ?? $item->url ?? '-' }}</code></td>
                                                    <td>@if($item->icon)<i class="{{ $item->icon }}"></i>@else-@endif</td>
                                                    <td>
                                                        <form action="{{ route('admin.menu-builder.toggle', $item) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.menu-builder.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @include('admin.menu-builder.partials.edit-modal', ['item' => $item])
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Menu Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.menu-builder.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g., Home">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Route</label>
                        <select name="route" class="form-select">
                            <option value="">-- Select Route --</option>
                            @foreach($availableRoutes as $route => $label)
                                <option value="{{ $route }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Or URL</label>
                        <input type="text" name="url" class="form-control" placeholder="https://...">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control" placeholder="fa-solid fa-home">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="1" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Menu Type</label>
                            <select name="menu_type" class="form-select">
                                <option value="header">Header</option>
                                <option value="footer">Footer</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3 d-flex align-items-end">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" checked>
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
