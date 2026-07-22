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
                    @if($menuItems->isEmpty())
                        <div class="text-center py-5">
                            <i class="fa-solid fa-bars text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-3 text-muted">No menu items. Click "Add Menu Item" to create one.</p>
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
                                    @foreach($menuItems as $item)
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
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Menu Item</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('admin.menu-builder.update', $item) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name *</label>
                                                                <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Route</label>
                                                                <select name="route" class="form-select">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach($availableRoutes as $route => $label)
                                                                        <option value="{{ $route }}" {{ $item->route === $route ? 'selected' : '' }}>{{ $label }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Or URL</label>
                                                                <input type="text" name="url" class="form-control" value="{{ $item->url }}" placeholder="https://...">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6 mb-3">
                                                                    <label class="form-label">Icon</label>
                                                                    <input type="text" name="icon" class="form-control" value="{{ $item->icon }}" placeholder="fa-solid fa-home">
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <label class="form-label">Order</label>
                                                                    <input type="number" name="order" class="form-control" value="{{ $item->order }}" min="0">
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="editActive{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="editActive{{ $item->id }}">Active</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                            <input type="number" name="order" class="form-control" value="{{ $menuItems->count() }}" min="0">
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" checked>
                        <label class="form-check-label" for="isActive">Active</label>
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
