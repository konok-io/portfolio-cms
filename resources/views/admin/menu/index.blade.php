@extends('admin.layouts.app')

@section('title', 'Menu Builder')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Menu Builder</h1>
        <p class="admin-breadcrumb mb-0">Manage your website navigation menu.</p>
    </div>
</div>

<x-validation-errors />
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    {{-- Add New Menu Item --}}
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header-custom">Add New Item</div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('admin.menu.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label-admin">Title <span class="required-star">*</span></label>
                        <input type="text" name="title" class="form-control" required placeholder="e.g., Services">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-admin">URL <span class="required-star">*</span></label>
                        <input type="text" name="url" class="form-control" required placeholder="e.g., /services">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-admin">Icon (FontAwesome class)</label>
                        <input type="text" name="icon" class="form-control" placeholder="e.g., fa-solid fa-briefcase">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-admin">Target</label>
                        <select name="target" class="form-select">
                            <option value="_self">Same window</option>
                            <option value="_blank">New window</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveNew" checked>
                            <label class="form-check-label" for="isActiveNew">Active</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="fa-solid fa-plus me-2"></i>Add Item
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Menu Items List --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header-custom">Navigation Menu Items</div>
            <div class="card-body-custom p-0">
                @if($menuItems->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-solid fa-list fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No menu items yet. Add your first item!</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width:40px"></th>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th>Icon</th>
                                    <th>Target</th>
                                    <th>Status</th>
                                    <th style="width:150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="menuSortable">
                                @foreach($menuItems as $item)
                                    <tr data-id="{{ $item->id }}" class="{{ !$item->is_active ? 'text-muted' : '' }}">
                                        <td>
                                            <i class="fa-solid fa-grip handle" style="cursor:grab"></i>
                                        </td>
                                        <td>{{ $item->position }}</td>
                                        <td>
                                            <strong>{{ $item->title }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-break">{{ $item->url }}</small>
                                        </td>
                                        <td>
                                            @if($item->icon)
                                                <i class="{{ $item->icon }}"></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->target === '_blank')
                                                <span class="badge bg-secondary">New tab</span>
                                            @else
                                                <span class="badge bg-light text-dark">Same tab</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.menu.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Delete this menu item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.menu.update', $item) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Menu Item</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">URL</label>
                                                            <input type="text" name="url" class="form-control" value="{{ $item->url }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Icon (FontAwesome class)</label>
                                                            <input type="text" name="icon" class="form-control" value="{{ $item->icon }}" placeholder="e.g., fa-solid fa-briefcase">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Target</label>
                                                            <select name="target" class="form-select">
                                                                <option value="_self" {{ $item->target === '_self' ? 'selected' : '' }}>Same window</option>
                                                                <option value="_blank" {{ $item->target === '_blank' ? 'selected' : '' }}>New window</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Position</label>
                                                            <input type="number" name="position" class="form-control" value="{{ $item->position }}">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="isActive{{ $item->id }}">Active</label>
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
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('menuSortable');
    if (el) {
        new Sortable(el, {
            handle: '.handle',
            animation: 150,
            onEnd: function(evt) {
                const order = [];
                el.querySelectorAll('tr[data-id]').forEach((row, index) => {
                    order.push(row.dataset.id);
                });
                
                fetch('{{ route('admin.menu.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ order }),
                });
            },
        });
    }
});
</script>
@endpush
