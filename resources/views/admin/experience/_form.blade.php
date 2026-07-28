<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label-admin">Company Name <span class="required-star">*</span></label>
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $experience->company_name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label-admin">Designation <span class="required-star">*</span></label>
        <input type="text" name="designation" class="form-control" value="{{ old('designation', $experience->designation ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">Start Date <span class="required-star">*</span></label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', optional($experience->start_date ?? null)->format('Y-m-d')) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', optional($experience->end_date ?? null)->format('Y-m-d')) }}" {{ old('is_current', $experience->is_current ?? false) ? 'disabled' : '' }}>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin d-block">Currently Working Here?</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_current" id="is_current" value="1" {{ old('is_current', $experience->is_current ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_current">Yes, this is my current role</label>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label-admin">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $experience->description ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label-admin">Sort Order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $experience->sort_order ?? 0) }}">
    </div>
</div>

<script>
    document.getElementById('is_current')?.addEventListener('change', function () {
        const endDate = document.getElementById('end_date');
        endDate.disabled = this.checked;
        if (this.checked) endDate.value = '';
    });
</script>
