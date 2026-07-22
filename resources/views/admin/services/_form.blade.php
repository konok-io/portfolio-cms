<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label-admin">Service Name <span class="required-star">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $service->name ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">Icon Class</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? '') }}" placeholder="fa-solid fa-laptop-code">
    </div>
    <div class="col-12">
        <label class="form-label-admin">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug ?? '') }}" placeholder="auto-generated-from-name">
        <small class="text-muted">Leave empty to auto-generate from name</small>
    </div>
    <div class="col-12">
        <label class="form-label-admin">Short Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $service->description ?? '') }}</textarea>
        <small class="text-muted">Brief description for service cards (max 255 chars)</small>
    </div>
    <div class="col-12">
        <label class="form-label-admin">Full Content (Detail Page)</label>
        <textarea name="content" class="form-control" rows="10">{{ old('content', $service->content ?? '') }}</textarea>
        <small class="text-muted">Detailed content for service detail page. Supports HTML.</small>
    </div>
    <div class="col-md-6">
        <label class="form-label-admin">Image</label>
        <input type="url" name="image" class="form-control" value="{{ old('image', $service->image ?? '') }}" placeholder="https://...">
        <small class="text-muted">Image URL for detail page</small>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">Sort Order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label-admin d-block">Status</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>
</div>
