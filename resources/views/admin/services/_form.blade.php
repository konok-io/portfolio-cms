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
        <label class="form-label-admin">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
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
