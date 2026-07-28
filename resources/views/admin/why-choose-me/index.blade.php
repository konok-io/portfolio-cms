@extends('admin.layouts.app')

@section('title', 'Why Choose Me - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-star me-2 text-primary"></i>
                Why Choose Me
            </h1>
        </div>
    </div>

    <div class="row g-4">
        <!-- Create Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-plus me-2 text-primary"></i>
                        Add New Item
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.why-choose-me.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                            <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon">
                                <option value="fa-solid fa-lightbulb">Lightbulb</option>
                                <option value="fa-solid fa-code">Code</option>
                                <option value="fa-solid fa-rocket">Rocket</option>
                                <option value="fa-solid fa-clock">Clock</option>
                                <option value="fa-solid fa-headset">Headset</option>
                                <option value="fa-solid fa-shield-halved">Shield</option>
                                <option value="fa-solid fa-handshake">Handshake</option>
                                <option value="fa-solid fa-gem">Gem</option>
                                <option value="fa-solid fa-palette">Palette</option>
                                <option value="fa-solid fa-bolt">Bolt</option>
                                <option value="fa-solid fa-users">Users</option>
                                <option value="fa-solid fa-award">Award</option>
                                <option value="fa-solid fa-check-circle">Check</option>
                                <option value="fa-solid fa-star">Star</option>
                                <option value="fa-solid fa-heart">Heart</option>
                                <option value="fa-solid fa-magic">Magic</option>
                                <option value="fa-solid fa-tools">Tools</option>
                                <option value="fa-solid fa-mobile-alt">Mobile</option>
                            </select>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g. Modern Design" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3"
                                      placeholder="Describe this feature..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                           value="{{ old('sort_order', 0) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-plus me-2"></i>Add Item
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Items List -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60px">#</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th style="width: 80px">Status</th>
                                        <th style="width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <i class="{{ $item->icon }} fa-lg text-primary"></i>
                                            </td>
                                            <td>
                                                <strong>{{ $item->title }}</strong>
                                                <p class="text-muted small mb-0">{{ Str::limit($item->description, 50) }}</p>
                                            </td>
                                            <td>
                                                @if($item->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary" 
                                                            onclick="editItem({{ $item->id }}, '{{ addslashes($item->icon) }}', '{{ addslashes($item->title) }}', '{{ addslashes(str_replace(["\r\n", "\n", "\r"], ' ', $item->description)) }}', {{ $item->sort_order }}, {{ $item->is_active ? 'true' : 'false' }})">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.why-choose-me.destroy', $item) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" 
                                                                onclick="return confirm('Delete this item?')">
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
                    @else
                        <div class="text-center py-5">
                            <i class="fa-solid fa-star fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No items found. Add your first "Why Choose Me" item!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_icon" class="form-label">Icon</label>
                            <select class="form-select" id="edit_icon" name="icon">
                                <option value="fa-solid fa-lightbulb">Lightbulb</option>
                                <option value="fa-solid fa-code">Code</option>
                                <option value="fa-solid fa-rocket">Rocket</option>
                                <option value="fa-solid fa-clock">Clock</option>
                                <option value="fa-solid fa-headset">Headset</option>
                                <option value="fa-solid fa-shield-halved">Shield</option>
                                <option value="fa-solid fa-handshake">Handshake</option>
                                <option value="fa-solid fa-gem">Gem</option>
                                <option value="fa-solid fa-palette">Palette</option>
                                <option value="fa-solid fa-bolt">Bolt</option>
                                <option value="fa-solid fa-users">Users</option>
                                <option value="fa-solid fa-award">Award</option>
                                <option value="fa-solid fa-check-circle">Check</option>
                                <option value="fa-solid fa-star">Star</option>
                                <option value="fa-solid fa-heart">Heart</option>
                                <option value="fa-solid fa-magic">Magic</option>
                                <option value="fa-solid fa-tools">Tools</option>
                                <option value="fa-solid fa-mobile-alt">Mobile</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="edit_sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="edit_sort_order" name="sort_order">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                                        <label class="form-check-label" for="edit_is_active">Active</label>
                                    </div>
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
</div>
@endsection

@push('scripts')
<script>
function editItem(id, icon, title, description, sortOrder, isActive) {
    document.getElementById('edit_icon').value = icon;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_sort_order').value = sortOrder;
    document.getElementById('edit_is_active').checked = isActive;
    document.getElementById('editForm').action = '/admin/why-choose-me/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>
@endpush
