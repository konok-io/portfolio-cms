<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label-admin">Skill Name <span class="required-star">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $skill->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label-admin">Category</label>
        <select name="category" class="form-control">
            <option value="Backend" {{ old('category', $skill->category ?? '') == 'Backend' ? 'selected' : '' }}>Backend</option>
            <option value="Frontend" {{ old('category', $skill->category ?? '') == 'Frontend' ? 'selected' : '' }}>Frontend</option>
            <option value="Database" {{ old('category', $skill->category ?? '') == 'Database' ? 'selected' : '' }}>Database</option>
            <option value="DevOps" {{ old('category', $skill->category ?? '') == 'DevOps' ? 'selected' : '' }}>DevOps</option>
            <option value="Tools" {{ old('category', $skill->category ?? '') == 'Tools' ? 'selected' : '' }}>Tools</option>
            <option value="Technical" {{ old('category', $skill->category ?? 'Technical') == 'Technical' ? 'selected' : '' }}>Technical</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">Percentage <span class="required-star">*</span></label>
        <input type="number" name="percentage" min="0" max="100" class="form-control" value="{{ old('percentage', $skill->percentage ?? 80) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">Icon Class</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $skill->icon ?? '') }}" placeholder="e.g. fa-brands fa-laravel">
        <small class="text-muted">Use any <a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a> class.</small>
    </div>
    <div class="col-md-2">
        <label class="form-label-admin">Sort Order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $skill->sort_order ?? 0) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label-admin d-block">Status</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $skill->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>
</div>
