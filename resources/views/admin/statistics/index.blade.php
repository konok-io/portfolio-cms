@extends('layouts.app')

@section('title', 'Statistics - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-chart-bar me-2 text-primary"></i>
                Statistics / Counter
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
                        Add New Statistic
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.statistics.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g. Projects Completed" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                            <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon">
                                <option value="fa fa-briefcase">Briefcase</option>
                                <option value="fa fa-users">Users</option>
                                <option value="fa fa-project-diagram">Projects</option>
                                <option value="fa fa-smile">Happy Clients</option>
                                <option value="fa fa-coffee">Coffee Cups</option>
                                <option value="fa fa-award">Awards</option>
                                <option value="fa fa-star">Stars</option>
                                <option value="fa fa-heart">Hearts</option>
                                <option value="fa fa-globe">Countries</option>
                                <option value="fa fa-code">Lines of Code</option>
                            </select>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="prefix" class="form-label">Prefix</label>
                                    <input type="text" class="form-control" id="prefix" name="prefix" 
                                           value="{{ old('prefix') }}" placeholder="e.g. +">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('value') is-invalid @enderror" 
                                           id="value" name="value" value="{{ old('value', 0) }}" min="0" required>
                                    @error('value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="suffix" class="form-label">Suffix</label>
                                    <input type="text" class="form-control" id="suffix" name="suffix" 
                                           value="{{ old('suffix') }}" placeholder="e.g. +">
                                </div>
                            </div>
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
                            <i class="fa-solid fa-plus me-2"></i>Add Statistic
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistics List -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if($statistics->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60px">#</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Value</th>
                                        <th style="width: 80px">Status</th>
                                        <th style="width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($statistics as $stat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <i class="{{ $stat->icon }} fa-lg text-primary"></i>
                                            </td>
                                            <td>
                                                <strong>{{ $stat->title }}</strong>
                                            </td>
                                            <td>
                                                {{ $stat->prefix ?? '' }}{{ number_format($stat->value) }}{{ $stat->suffix ?? '' }}
                                            </td>
                                            <td>
                                                @if($stat->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary" 
                                                            onclick="editStatistic({{ $stat->id }}, '{{ $stat->title }}', '{{ $stat->icon }}', {{ $stat->value }}, '{{ $stat->prefix ?? '' }}', '{{ $stat->suffix ?? '' }}', {{ $stat->sort_order }}, {{ $stat->is_active ? 'true' : 'false' }})">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.statistics.destroy', $stat) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" 
                                                                onclick="return confirm('Delete this statistic?')">
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
                            <i class="fa-solid fa-chart-bar fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No statistics found. Add your first counter!</p>
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
                    <h5 class="modal-title">Edit Statistic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_icon" class="form-label">Icon</label>
                            <select class="form-select" id="edit_icon" name="icon">
                                <option value="fa fa-briefcase">Briefcase</option>
                                <option value="fa fa-users">Users</option>
                                <option value="fa fa-project-diagram">Projects</option>
                                <option value="fa fa-smile">Happy Clients</option>
                                <option value="fa fa-coffee">Coffee Cups</option>
                                <option value="fa fa-award">Awards</option>
                                <option value="fa fa-star">Stars</option>
                                <option value="fa fa-heart">Hearts</option>
                                <option value="fa fa-globe">Countries</option>
                                <option value="fa fa-code">Lines of Code</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="edit_prefix" class="form-label">Prefix</label>
                                    <input type="text" class="form-control" id="edit_prefix" name="prefix">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="edit_value" class="form-label">Value</label>
                                    <input type="number" class="form-control" id="edit_value" name="value" min="0" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="edit_suffix" class="form-label">Suffix</label>
                                    <input type="text" class="form-control" id="edit_suffix" name="suffix">
                                </div>
                            </div>
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
function editStatistic(id, title, icon, value, prefix, suffix, sortOrder, isActive) {
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_icon').value = icon;
    document.getElementById('edit_value').value = value;
    document.getElementById('edit_prefix').value = prefix;
    document.getElementById('edit_suffix').value = suffix;
    document.getElementById('edit_sort_order').value = sortOrder;
    document.getElementById('edit_is_active').checked = isActive;
    document.getElementById('editForm').action = '/admin/statistics/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>
@endpush
