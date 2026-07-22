@extends('admin.layouts.app')

@section('title', 'Certifications - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-certificate me-2 text-primary"></i>
                Certifications & Badges
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
                        Add New Certification
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data" id="certificationForm">
                        @csrf
                        <input type="hidden" id="cert_id" name="cert_id" value="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Certification Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="issuer" class="form-label">Issuing Organization <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('issuer') is-invalid @enderror" 
                                   id="issuer" name="issuer" value="{{ old('issuer') }}" required>
                            @error('issuer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="issue_date" class="form-label">Issue Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('issue_date') is-invalid @enderror" 
                                           id="issue_date" name="issue_date" value="{{ old('issue_date') }}" required>
                                    @error('issue_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" 
                                           id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                                    @error('expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="credential_id" class="form-label">Credential ID</label>
                            <input type="text" class="form-control" id="credential_id" name="credential_id" 
                                   value="{{ old('credential_id') }}">
                        </div>

                        <div class="mb-3">
                            <label for="credential_url" class="form-label">Credential URL</label>
                            <input type="url" class="form-control @error('credential_url') is-invalid @enderror" 
                                   id="credential_url" name="credential_url" value="{{ old('credential_url') }}">
                            @error('credential_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="badge_image" class="form-label">Badge Image</label>
                            <input type="file" class="form-control @error('badge_image') is-invalid @enderror" 
                                   id="badge_image" name="badge_image" accept="image/*">
                            <small class="text-muted">Recommended size: 200x200px</small>
                            @error('badge_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="2">{{ old('description') }}</textarea>
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

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1" id="submitBtn">
                                <i class="fa-solid fa-plus me-2"></i>Add Certification
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()" id="cancelBtn" style="display: none;">
                                <i class="fa-solid fa-times me-2"></i>Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Certifications List -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if($certifications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th>Certification</th>
                                        <th>Issuer</th>
                                        <th>Issue Date</th>
                                        <th style="width: 100px">Status</th>
                                        <th style="width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certifications as $cert)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($cert->badge_image)
                                                        <img src="{{ asset('storage/' . $cert->badge_image) }}" 
                                                             alt="{{ $cert->name }}" class="rounded" width="40" height="40">
                                                    @else
                                                        <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" 
                                                             style="width: 40px; height: 40px;">
                                                            <i class="fa-solid fa-certificate"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $cert->name }}</strong>
                                                        @if($cert->is_expired)
                                                            <span class="badge bg-danger ms-1">Expired</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $cert->issuer }}</td>
                                            <td>{{ $cert->issue_date->format('M Y') }}</td>
                                            <td>
                                                @if($cert->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    @if($cert->credential_url)
                                                        <a href="{{ $cert->credential_url }}" target="_blank" class="btn btn-outline-info" title="View Credential">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-primary" 
                                                            onclick="editCertification({{ $cert->id }}, '{{ addslashes($cert->name) }}', '{{ addslashes($cert->issuer) }}', '{{ $cert->issue_date?->format('Y-m-d') }}', '{{ $cert->expiry_date?->format('Y-m-d') }}', '{{ $cert->credential_id ?? '' }}', '{{ $cert->credential_url ?? '' }}', `{{ addslashes($cert->description ?? '') }}`, {{ $cert->sort_order }}, {{ $cert->is_active ? 'true' : 'false' }})">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" 
                                                                onclick="return confirm('Delete this certification?')">
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
                            <i class="fa-solid fa-certificate fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No certifications found. Add your first one!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editCertification(id, name, issuer, issueDate, expiryDate, credentialId, credentialUrl, description, sortOrder, isActive) {
    document.getElementById('cert_id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('issuer').value = issuer;
    document.getElementById('issue_date').value = issueDate;
    document.getElementById('expiry_date').value = expiryDate;
    document.getElementById('credential_id').value = credentialId;
    document.getElementById('credential_url').value = credentialUrl;
    document.getElementById('description').value = description;
    document.getElementById('sort_order').value = sortOrder;
    document.getElementById('is_active').checked = isActive;
    
    // Change form action to update
    document.getElementById('certificationForm').action = '/admin/certifications/' + id;
    
    // Show hidden method field
    let methodField = document.getElementById('method_field');
    if (!methodField) {
        methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.id = 'method_field';
        methodField.name = '_method';
        methodField.value = 'PUT';
        document.getElementById('certificationForm').appendChild(methodField);
    }
    methodField.value = 'PUT';
    
    // Change button text and show cancel
    document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-save me-2"></i>Update Certification';
    document.querySelector('#certificationForm h5').innerHTML = '<i class="fa-solid fa-edit me-2 text-primary"></i>Edit Certification';
    document.getElementById('cancelBtn').style.display = 'inline-block';
    
    // Scroll to form
    document.getElementById('certificationForm').scrollIntoView({ behavior: 'smooth' });
}

function resetForm() {
    document.getElementById('certificationForm').reset();
    document.getElementById('cert_id').value = '';
    document.getElementById('certificationForm').action = '/admin/certifications';
    let methodField = document.getElementById('method_field');
    if (methodField) methodField.remove();
    document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-plus me-2"></i>Add Certification';
    document.querySelector('#certificationForm h5').innerHTML = '<i class="fa-solid fa-plus me-2 text-primary"></i>Add New Certification';
    document.getElementById('cancelBtn').style.display = 'none';
}
</script>
@endpush
