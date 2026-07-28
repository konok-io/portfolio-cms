<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label-admin">Institute Name <span class="required-star">*</span></label>
        <input type="text" name="institute_name" class="form-control" value="{{ old('institute_name', $education->institute_name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label-admin">Degree <span class="required-star">*</span></label>
        <input type="text" name="degree" class="form-control" value="{{ old('degree', $education->degree ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label-admin">Start Year <span class="required-star">*</span></label>
        <input type="text" name="start_year" maxlength="4" class="form-control" value="{{ old('start_year', $education->start_year ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label-admin">End Year</label>
        <input type="text" name="end_year" maxlength="4" class="form-control" value="{{ old('end_year', $education->end_year ?? '') }}" placeholder="Leave blank if ongoing">
    </div>
    <div class="col-12">
        <label class="form-label-admin">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $education->description ?? '') }}</textarea>
    </div>
    <div class="col-md-3">
        <label class="form-label-admin">Sort Order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $education->sort_order ?? 0) }}">
    </div>
</div>
