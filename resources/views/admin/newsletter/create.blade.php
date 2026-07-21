@extends('admin.layouts.app')

@section('title', 'Create Campaign - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fa-solid fa-plus-circle me-2 text-primary"></i>
                    Create Newsletter Campaign
                </h1>
                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="alert alert-info">
                <i class="fa-solid fa-info-circle me-2"></i>
                This campaign will be sent to <strong>{{ $subscribersCount }} subscriber(s)</strong>.
            </div>

            <form action="{{ route('admin.newsletter.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject Line <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                           id="subject" name="subject" value="{{ old('subject') }}" 
                           placeholder="Enter email subject" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="12" 
                              placeholder="Write your newsletter content here (HTML is supported)">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">You can use HTML tags for formatting</small>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Delivery Options</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="send_now" name="send_now" value="1">
                            <label class="form-check-label" for="send_now">
                                <strong>Send Immediately</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="schedule" name="schedule" value="1">
                            <label class="form-check-label" for="schedule">
                                <strong>Schedule for Later</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row schedule-fields" style="display: none;">
                    <div class="col-md-4 mb-3">
                        <label for="scheduled_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" 
                               min="{{ date('Y-m-d') }}" value="{{ old('scheduled_date') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="scheduled_time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="scheduled_time" name="scheduled_time" 
                               value="{{ old('scheduled_time', '09:00') }}">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary" name="action" value="save">
                        <i class="fa-solid fa-save me-2"></i>Save as Draft
                    </button>
                    <button type="submit" class="btn btn-success" name="action" value="send">
                        <i class="fa-solid fa-paper-plane me-2"></i>Send Now
                    </button>
                    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const scheduleCheckbox = document.getElementById('schedule');
    const sendNowCheckbox = document.getElementById('send_now');
    const scheduleFields = document.querySelector('.schedule-fields');
    
    function updateFields() {
        scheduleFields.style.display = scheduleCheckbox.checked ? 'flex' : 'none';
        
        // Make fields required when schedule is checked
        document.getElementById('scheduled_date').required = scheduleCheckbox.checked;
    }
    
    scheduleCheckbox.addEventListener('change', updateFields);
    updateFields();
});
</script>
@endpush
