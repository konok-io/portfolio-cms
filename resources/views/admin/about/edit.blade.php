@extends('admin.layouts.app')

@section('title', 'About Me')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>About Me</h1>
        <p class="admin-breadcrumb mb-0">Manage your personal information shown on the homepage.</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Basic Information</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">Full Name <span class="required-star">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $about->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Designation / Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $about->title) }}" placeholder="e.g. Full Stack Web Developer">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Short Introduction</label>
                            <textarea name="short_intro" class="form-control" rows="2" maxlength="500">{{ old('short_intro', $about->short_intro) }}</textarea>
                            <small class="text-muted">Shown in the hero section. Max 500 characters.</small>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label-admin mb-0">Description</label>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openFileManager()">
                                    <i class="fa-solid fa-image me-1"></i>Insert Image from Gallery
                                </button>
                            </div>
                            <textarea name="description" id="description" class="form-control" rows="8">{{ old('description', $about->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">Contact Information</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $about->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $about->phone) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $about->address) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-custom">Social Links</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-linkedin me-1"></i> LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $about->linkedin) }}" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-github me-1"></i> GitHub</label>
                            <input type="url" name="github" class="form-control" value="{{ old('github', $about->github) }}" placeholder="https://github.com/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-facebook me-1"></i> Facebook</label>
                            <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $about->facebook) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-x-twitter me-1"></i> Twitter / X</label>
                            <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $about->twitter) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-instagram me-1"></i> Instagram</label>
                            <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $about->instagram) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Profile Photo</div>
                <div class="card-body-custom text-center">
                    <img id="photoPreview" src="{{ $about->photo_url }}" alt="Photo preview" class="rounded-3 mb-3 w-100" style="aspect-ratio:1/1; object-fit:cover;">
                    <input type="file" name="photo" class="form-control" accept="image/*" data-preview-target="#photoPreview">
                    <small class="text-muted d-block mt-2">JPG, PNG or WEBP. Max 2MB.</small>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">CV / Resume</div>
                <div class="card-body-custom">
                    @if($about->cv_url)
                        <a href="{{ $about->cv_url }}" target="_blank" class="btn btn-outline-secondary w-100 mb-3 btn-sm">
                            <i class="fa-solid fa-file-pdf me-2"></i>View Current CV
                        </a>
                    @endif
                    <input type="file" name="cv_file" class="form-control" accept="application/pdf">
                    <small class="text-muted d-block mt-2">PDF only. Max 5MB.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
            </button>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    let descriptionEditor;
    ClassicEditor.create(document.querySelector('#description'))
        .then(editor => { descriptionEditor = editor; })
        .catch(console.error);

    window.addEventListener('message', function (e) {
        if (typeof e.data === 'string' && e.data.startsWith('http') && descriptionEditor) {
            descriptionEditor.model.change(writer => {
                const imageElement = writer.createElement('imageBlock', { src: e.data });
                descriptionEditor.model.insertContent(imageElement, descriptionEditor.model.document.selection);
            });
        }
    });
</script>
@endpush
