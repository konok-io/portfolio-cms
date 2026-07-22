@extends('front.layouts.app')

@section('seo_title', 'Client Portal - ' . $portal->project_name)

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Header --}}
        <div class="row mb-4">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Client Portal</li>
                    </ol>
                </nav>
                <h1 class="section-title mb-2">{{ $portal->project_name }}</h1>
                <p class="text-muted mb-0">Welcome back, {{ $portal->name }}!</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <form method="POST" action="{{ route('client-portal.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- Status Alert --}}
        <div class="alert alert-{{ $portal->status === 'completed' ? 'success' : ($portal->status === 'on_hold' ? 'secondary' : 'info') }} d-flex align-items-center mb-4">
            <i class="fa-solid fa-{{ $portal->status === 'completed' ? 'check-circle' : ($portal->status === 'on_hold' ? 'pause-circle' : 'info-circle') }} me-3 fa-lg"></i>
            <div>
                <strong>Project Status:</strong> {{ $portal->status_label }}
            </div>
        </div>

        {{-- Main Content --}}
        <div class="row g-4">
            {{-- Progress Card --}}
            <div class="col-lg-4">
                <div class="admin-card">
                    <div class="card-header-custom">Project Progress</div>
                    <div class="card-body-custom text-center">
                        <div class="progress-circle mx-auto mb-3" style="width: 120px; height: 120px;">
                            <svg viewBox="0 0 36 36" class="circular-chart">
                                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                <path class="circle" stroke-dasharray="{{ $portal->progress }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                <text x="18" y="20.35" class="percentage">{{ $portal->progress }}%</text>
                            </svg>
                        </div>
                        
                        @if($portal->deadline)
                            <div class="mt-3">
                                <i class="fa-solid fa-calendar me-1 text-muted"></i>
                                <strong>Deadline:</strong> {{ $portal->deadline->format('M d, Y') }}
                                @if($portal->deadline->isPast())
                                    <span class="badge bg-danger ms-2">Overdue</span>
                                @else
                                    <span class="text-muted">({{ $portal->deadline->diffForHumans() }})</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Project Details --}}
            <div class="col-lg-8">
                <div class="admin-card">
                    <div class="card-header-custom">Project Information</div>
                    <div class="card-body-custom">
                        @if($portal->notes)
                            <div class="mb-4">
                                <h6><i class="fa-solid fa-info-circle me-2 text-primary-custom"></i>Project Notes</h6>
                                <div class="p-3 bg-light rounded-3">
                                    <p class="mb-0" style="white-space: pre-wrap;">{{ $portal->notes }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <small class="text-muted">Client</small>
                                    <h6 class="mb-0">{{ $portal->name }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <small class="text-muted">Email</small>
                                    <h6 class="mb-0">
                                        <a href="mailto:{{ $portal->email }}">{{ $portal->email }}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Files --}}
            <div class="col-12">
                <div class="admin-card">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-folder-open me-2"></i>Project Files
                    </div>
                    <div class="card-body-custom">
                        @if($portal->files && count($portal->files) > 0)
                            <div class="row g-3">
                                @foreach($portal->files as $file)
                                    <div class="col-md-6 col-lg-4">
                                        <a href="{{ $file['url'] }}" target="_blank" class="text-decoration-none">
                                            <div class="file-card p-3 border rounded-3 h-100">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="file-icon">
                                                        <i class="fa-solid fa-file fa-lg text-primary-custom"></i>
                                                    </div>
                                                    <div class="overflow-hidden">
                                                        <h6 class="mb-0 text-truncate">{{ $file['name'] }}</h6>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($file['uploaded_at'])->format('M d, Y') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No files available yet. Check back soon!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="mt-5 text-center">
            <p class="text-muted">
                Need help with your project?
                <a href="{{ route('contact') }}" class="btn btn-sm btn-primary-custom ms-2">
                    <i class="fa-solid fa-envelope me-1"></i>Contact Us
                </a>
            </p>
        </div>
    </div>
</section>

<style>
.progress-circle {
    position: relative;
}
.circular-chart {
    display: block;
    width: 100%;
    height: 100%;
}
.circle-bg {
    fill: none;
    stroke: #eee;
    stroke-width: 3.8;
}
.circle {
    fill: none;
    stroke: var(--color-primary, #4F2FE8);
    stroke-width: 3.8;
    stroke-linecap: round;
    animation: progress 1s ease-out forwards;
}
@keyframes progress {
    0% { stroke-dasharray: 0 100; }
}
.percentage {
    fill: #333;
    font-size: 0.5em;
    text-anchor: middle;
    font-weight: bold;
}
.file-card {
    transition: all 0.3s ease;
}
.file-card:hover {
    border-color: var(--color-primary, #4F2FE8) !important;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
