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
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Menu Type</label>
                            <select name="menu_type" class="form-select">
                                <option value="header" {{ ($item->menu_type ?? 'header') == 'header' ? 'selected' : '' }}>Header</option>
                                <option value="footer" {{ $item->menu_type == 'footer' ? 'selected' : '' }}>Footer</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3 d-flex align-items-end">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="editActive{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="editActive{{ $item->id }}">Active</label>
                            </div>
                        </div>
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
