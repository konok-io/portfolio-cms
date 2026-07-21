@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Dashboard</h1>
        <p class="admin-breadcrumb mb-0">Welcome back, {{ auth()->user()->name }} 👋</p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(37,99,235,0.1); color:#2563EB;"><i class="fa-solid fa-diagram-project"></i></div>
            <div>
                <div class="stat-value">{{ $stats['projects'] }}</div>
                <div class="stat-label">Total Projects</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(249,115,22,0.1); color:#F97316;"><i class="fa-solid fa-briefcase"></i></div>
            <div>
                <div class="stat-value">{{ $stats['services'] }}</div>
                <div class="stat-label">Total Services</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(34,197,94,0.1); color:#16a34a;"><i class="fa-solid fa-chart-simple"></i></div>
            <div>
                <div class="stat-value">{{ $stats['skills'] }}</div>
                <div class="stat-label">Total Skills</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(168,85,247,0.1); color:#9333ea;"><i class="fa-solid fa-quote-left"></i></div>
            <div>
                <div class="stat-value">{{ $stats['testimonials'] }}</div>
                <div class="stat-label">Total Testimonials</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(14,165,233,0.1); color:#0ea5e9;"><i class="fa-solid fa-newspaper"></i></div>
            <div>
                <div class="stat-value">{{ $stats['blogs'] }}</div>
                <div class="stat-label">Total Blogs</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(220,38,38,0.1); color:#dc2626;"><i class="fa-solid fa-envelope"></i></div>
            <div>
                <div class="stat-value">{{ $stats['messages'] }}</div>
                <div class="stat-label">Messages ({{ $stats['unread_messages'] }} unread)</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1); color:#3b82f6;"><i class="fa-solid fa-building"></i></div>
            <div>
                <div class="stat-value">{{ $stats['experiences'] }}</div>
                <div class="stat-label">Work Experience</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1); color:#10b981;"><i class="fa-solid fa-graduation-cap"></i></div>
            <div>
                <div class="stat-value">{{ $stats['educations'] }}</div>
                <div class="stat-label">Education</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(37,99,235,0.1); color:#2563EB;"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-value">{{ $stats['visitors'] }}</div>
                <div class="stat-label">Total Visitors</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(249,115,22,0.1); color:#F97316;"><i class="fa-solid fa-eye"></i></div>
            <div>
                <div class="stat-value">{{ $stats['visitors_today'] }}</div>
                <div class="stat-label">Visitors Today</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(14,165,233,0.1); color:#0ea5e9;"><i class="fa-solid fa-globe"></i></div>
            <div>
                <div class="stat-value">{{ $topCountries->count() > 0 ? $topCountries->first()->total : 0 }}</div>
                <div class="stat-label">Top Country Visitors</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(168,85,247,0.1); color:#9333ea;"><i class="fa-solid fa-file-alt"></i></div>
            <div>
                <div class="stat-value">{{ $topPages->count() > 0 ? $topPages->first()->total : 0 }}</div>
                <div class="stat-label">Top Page Views</div>
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header-custom">Quick Actions</div>
            <div class="card-body-custom">
                <div class="row g-2">
                    <div class="col-md-2 col-6">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa-solid fa-plus me-1"></i> New Project
                        </a>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa-solid fa-plus me-1"></i> New Blog
                        </a>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa-solid fa-plus me-1"></i> New Service
                        </a>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="{{ route('admin.skills.create') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa-solid fa-plus me-1"></i> New Skill
                        </a>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="{{ route('admin.experience.create') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa-solid fa-plus me-1"></i> Add Experience
                        </a>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa-solid fa-envelope me-1"></i> View Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== License Information ===================== --}}
@isset($license)
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header-custom d-flex align-items-center justify-content-between">
                <span><i class="fa-solid fa-key me-2"></i>License Information</span>
                @if(($license['ready'] ?? false) && ($license['status'] ?? '') !== '')
                    @php
                        $st = strtolower($license['status'] ?? 'unknown');
                        $badge = match($st) {
                            'active'  => 'success',
                            'grace'   => 'warning',
                            'expired', 'blocked', 'verification_failed' => 'danger',
                            'pending' => 'secondary',
                            default   => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $badge }} text-uppercase">{{ $st }}</span>
                @endif
            </div>
            <div class="card-body-custom">
                @if(! ($license['ready'] ?? false))
                    {{-- Package present but not migrated/activated yet --}}
                    <div class="text-muted">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        License package detected, but not set up yet. Run
                        <code>php artisan mrh-license:install</code> to activate.
                    </div>
                @else
                    <div class="row g-4">
                        {{-- Expiry + days left highlight --}}
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 border h-100">
                                <div class="small text-muted mb-1">Expires On</div>
                                <div class="h5 mb-1">
                                    {{ $license['expires_at'] ? $license['expires_at']->format('d M Y') : 'No expiry' }}
                                </div>
                                @if(!is_null($license['days_left']))
                                    @php $dl = (int) $license['days_left']; @endphp
                                    @if($dl > 0)
                                        <span class="badge bg-success">{{ $dl }} day{{ $dl === 1 ? '' : 's' }} left</span>
                                    @elseif($dl === 0)
                                        <span class="badge bg-warning text-dark">Expires today</span>
                                    @else
                                        <span class="badge bg-danger">Expired {{ abs($dl) }} day{{ abs($dl) === 1 ? '' : 's' }} ago</span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- Verification info --}}
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 border h-100">
                                <div class="small text-muted mb-1">Last Verified</div>
                                <div class="mb-2">{{ $license['last_verified_at'] ? $license['last_verified_at']->diffForHumans() : 'Never' }}</div>
                                <div class="small text-muted mb-1">Activated</div>
                                <div>
                                    @if($license['activated'])
                                        <span class="text-success"><i class="fa-solid fa-circle-check me-1"></i>Yes</span>
                                    @else
                                        <span class="text-danger"><i class="fa-solid fa-circle-xmark me-1"></i>No</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Binding info --}}
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 border h-100">
                                <div class="small text-muted mb-1">Server Type</div>
                                <div class="mb-2 text-capitalize">{{ $license['server_type'] ?? '—' }}</div>
                                <div class="small text-muted mb-1">Domain</div>
                                <div class="text-break">{{ $license['normalized_domain'] ?? '—' }}</div>
                            </div>
                        </div>

                        {{-- Installation ID (full width) --}}
                        <div class="col-12">
                            <div class="p-3 rounded-3 border bg-light">
                                <div class="small text-muted mb-1">Installation ID</div>
                                <code class="text-break">{{ $license['installation_id'] ?? '—' }}</code>
                            </div>
                        </div>

                        @if($license['grace_ends_at'] && in_array(strtolower($license['status'] ?? ''), ['grace']))
                        <div class="col-12">
                            <div class="alert alert-warning mb-0">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                Grace period ends {{ $license['grace_ends_at']->format('d M Y') }} ({{ $license['grace_ends_at']->diffForHumans() }}).
                            </div>
                        </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endisset

<div class="row g-3">
    {{-- Charts Section --}}
    <div class="col-lg-8">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom">Visitor Trend (Last 14 Days)</div>
            <div class="card-body-custom">
                <canvas id="visitorChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom">Browser Breakdown</div>
            <div class="card-body-custom d-flex align-items-center justify-content-center h-100">
                <canvas id="browserChart" height="150"></canvas>
            </div>
        </div>
    </div>

    {{-- Top Countries, Top Pages, Quick Stats --}}
    <div class="col-lg-4">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom">
                <i class="fa-solid fa-globe me-2"></i>Top Countries
            </div>
            <div class="card-body-custom p-0" style="min-height:150px;">
                @forelse($topCountries as $index => $country)
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-circle" style="width:24px;height:24px;line-height:16px;font-size:11px;">{{ $index + 1 }}</span>
                            <span class="small fw-medium">{{ $country->country ?: 'Unknown' }}</span>
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $country->total }} visits</span>
                    </div>
                @empty
                    <p class="text-muted small text-center py-4 mb-0">No country data available</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom">
                <i class="fa-solid fa-file-alt me-2"></i>Top Pages
            </div>
            <div class="card-body-custom p-0" style="min-height:150px;">
                @forelse($topPages as $index => $page)
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-info rounded-circle" style="width:24px;height:24px;line-height:16px;font-size:11px;">{{ $index + 1 }}</span>
                            <span class="small fw-medium text-truncate" style="max-width:120px;" title="{{ $page->page_url }}">{{ basename($page->page_url) ?: '/' }}</span>
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill">{{ $page->total }} views</span>
                    </div>
                @empty
                    <p class="text-muted small text-center py-4 mb-0">No page data available</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom">
                <i class="fa-solid fa-chart-pie me-2"></i>Quick Stats
            </div>
            <div class="card-body-custom" style="min-height:150px;">
                <div class="row g-2 text-center h-100 d-flex align-items-center">
                    <div class="col-6">
                        <div class="p-2 rounded-3 bg-light">
                            <div class="h5 mb-0 text-primary">{{ $stats['visitors'] > 0 ? number_format($stats['visitors']) : 0 }}</div>
                            <small class="text-muted">Total Views</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded-3 bg-light">
                            <div class="h5 mb-0 text-success">{{ $stats['visitors_today'] }}</div>
                            <small class="text-muted">Today</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded-3 bg-light">
                            <div class="h5 mb-0 text-warning">{{ $stats['messages'] }}</div>
                            <small class="text-muted">Messages</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded-3 bg-light">
                            <div class="h5 mb-0 text-info">{{ $stats['unread_messages'] }}</div>
                            <small class="text-muted">Unread</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Projects by Status & Skills Status --}}
    <div class="col-lg-6">
        <div class="admin-card mb-3">
            <div class="card-header-custom">Projects by Status</div>
            <div class="card-body-custom">
                <canvas id="projectChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="admin-card mb-3">
            <div class="card-header-custom">Skills Status</div>
            <div class="card-body-custom">
                <canvas id="skillsChart" height="150"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Projects Table --}}
    <div class="col-lg-6">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                Recent Projects
                <a href="{{ route('admin.projects.index') }}" class="small">View All</a>
            </div>
            <div class="table-responsive" style="min-height:150px;">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProjects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td><span class="badge bg-light text-dark border text-capitalize">{{ str_replace('_',' ',$project->status) }}</span></td>
                                <td>{{ $project->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No projects yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Blog Posts --}}
    <div class="col-lg-6">
        <div class="admin-card mb-3 h-100">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                Recent Blog Posts
                <a href="{{ route('admin.blog.index') }}" class="small">View All</a>
            </div>
            <div class="table-responsive" style="min-height:150px;">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBlogs as $blog)
                            <tr>
                                <td>{{ \Illuminate\Support\Str::limit($blog->title, 30) }}</td>
                                <td>
                                    @if($blog->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $blog->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No blog posts yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                Recent Messages
                <a href="{{ route('admin.messages.index') }}" class="small">View All</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($recentMessages as $message)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-semibold small">{{ $message->name }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($message->message, 60) }}</div>
                            <div class="text-muted small mt-1"><i class="fa-solid fa-clock me-1"></i>{{ $message->created_at->diffForHumans() }}</div>
                        </div>
                        @if(!$message->is_read)
                            <span class="badge bg-danger">New</span>
                        @endif
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted small py-4">No messages yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    // Visitor Trend Chart
    const visitorCtx = document.getElementById('visitorChart');
    new Chart(visitorCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($visitorChart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))->toArray()) !!},
            datasets: [{
                label: 'Visitors',
                data: {!! json_encode($visitorChart->pluck('total')) !!},
                borderColor: '#2563EB',
                backgroundColor: 'rgba(37,99,235,0.08)',
                fill: true,
                tension: 0.35,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } },
            interaction: { intersect: false, mode: 'index' }
        }
    });

    // Browser Breakdown Chart
    const browserCtx = document.getElementById('browserChart');
    new Chart(browserCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($browserStats->pluck('browser')) !!},
            datasets: [{
                data: {!! json_encode($browserStats->pluck('total')) !!},
                backgroundColor: ['#2563EB', '#F97316', '#0F172A', '#16a34a', '#9333ea', '#0ea5e9'],
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
            cutout: '60%'
        }
    });

    // Project Status Chart
    const projectCtx = document.getElementById('projectChart');
    new Chart(projectCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($projectStats->pluck('status')->map(fn($s) => ucfirst(str_replace('_', ' ', $s)))->toArray()) !!},
            datasets: [{
                label: 'Projects',
                data: {!! json_encode($projectStats->pluck('total')) !!},
                backgroundColor: ['#16a34a', '#F97316', '#2563EB', '#9333ea', '#dc2626'],
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Skills Status Chart
    const skillsCtx = document.getElementById('skillsChart');
    new Chart(skillsCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($skillStats->pluck('is_active')->map(fn($a) => $a ? 'Active' : 'Inactive')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($skillStats->pluck('total')) !!},
                backgroundColor: ['#16a34a', '#dc2626'],
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
            cutout: '60%'
        }
    });
</script>
@endpush
