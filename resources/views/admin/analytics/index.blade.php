@extends('admin.layouts.app')

@section('title', 'Analytics - Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chart.js/4.4.1/chart.min.css">
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fa-solid fa-chart-line me-2 text-primary"></i>
                    Analytics Dashboard
                </h1>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.analytics.index', ['period' => 7]) }}" 
                       class="btn btn-sm {{ $period == 7 ? 'btn-primary' : 'btn-outline-secondary' }}">7 Days</a>
                    <a href="{{ route('admin.analytics.index', ['period' => 30]) }}" 
                       class="btn btn-sm {{ $period == 30 ? 'btn-primary' : 'btn-outline-secondary' }}">30 Days</a>
                    <a href="{{ route('admin.analytics.index', ['period' => 90]) }}" 
                       class="btn btn-sm {{ $period == 90 ? 'btn-primary' : 'btn-outline-secondary' }}">90 Days</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fa-solid fa-users text-primary fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Visits</h6>
                            <h3 class="mb-0">{{ number_format($totalVisitors) }}</h3>
                        </div>
                        <div class="text-end">
                            @if($visitorChange != 0)
                                <span class="badge bg-{{ $visitorChange > 0 ? 'success' : 'danger' }}">
                                    <i class="fa-solid fa-arrow-{{ $visitorChange > 0 ? 'up' : 'down' }} me-1"></i>
                                    {{ abs($visitorChange) }}%
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fa-solid fa-user-check text-success fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Unique Visitors</h6>
                            <h3 class="mb-0">{{ number_format($uniqueVisitors) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fa-solid fa-chart-simple text-info fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Avg. Daily Visits</h6>
                            <h3 class="mb-0">{{ number_format($totalVisitors / max($period, 1), 1) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Visitors Chart -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-chart-area me-2 text-primary"></i>
                        Visitor Trends
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="visitorsChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Device Distribution -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-mobile-screen-button me-2 text-primary"></i>
                        Device Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="deviceChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Charts -->
    <div class="row g-4 mb-4">
        <!-- Browser Stats -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-globe me-2 text-primary"></i>
                        Top Browsers
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="browserChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Platform Stats -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-laptop me-2 text-primary"></i>
                        Platforms
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="platformChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Row -->
    <div class="row g-4 mb-4">
        <!-- Top Pages -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-file-lines me-2 text-primary"></i>
                        Most Visited Pages
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 70%">Page</th>
                                    <th class="text-end">Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topPages as $page)
                                    <tr>
                                        <td>
                                            <a href="{{ $page->page_url }}" target="_blank" class="text-decoration-none">
                                                {{ Str::limit($page->page_url, 50) }}
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">{{ number_format($page->count) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Countries -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-earth-americas me-2 text-primary"></i>
                        Top Countries
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 70%">Country</th>
                                    <th class="text-end">Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countryStats as $country)
                                    <tr>
                                        <td>
                                            <span class="me-2">{{ $country->country ?? 'Unknown' }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">{{ number_format($country->count) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Visitors -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>
                        Recent Visitors
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Platform</th>
                                    <th>Device</th>
                                    <th>Page</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVisitors as $visitor)
                                    <tr>
                                        <td>
                                            <code>{{ $visitor->ip_address }}</code>
                                        </td>
                                        <td>{{ $visitor->browser ?? 'Unknown' }}</td>
                                        <td>{{ $visitor->platform ?? 'Unknown' }}</td>
                                        <td>
                                            @if($visitor->device === 'Desktop')
                                                <i class="fa-solid fa-desktop text-secondary"></i>
                                            @elseif($visitor->device === 'Mobile')
                                                <i class="fa-solid fa-mobile-screen text-secondary"></i>
                                            @else
                                                <i class="fa-solid fa-tablet-screen text-secondary"></i>
                                            @endif
                                            {{ $visitor->device ?? 'Unknown' }}
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($visitor->page_url, 30) }}</small>
                                        </td>
                                        <td>
                                            <small>{{ $visitor->visited_date->format('M d, Y') }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No visitors recorded yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/4.4.1/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart colors
    const colors = {
        primary: '#2563eb',
        success: '#16a34a',
        warning: '#d97706',
        info: '#0891b2',
        purple: '#7c3aed',
        pink: '#ec4899',
        gray: '#6b7280'
    };

    // Visitors Chart
    const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
    new Chart(visitorsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dailyVisitors->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))->toArray()) !!},
            datasets: [{
                label: 'Visitors',
                data: {!! json_encode($dailyVisitors->pluck('count')->toArray()) !!},
                borderColor: colors.primary,
                backgroundColor: colors.primary + '20',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: colors.primary
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Device Chart
    const deviceCtx = document.getElementById('deviceChart').getContext('2d');
    new Chart(deviceCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($deviceStats->pluck('device')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($deviceStats->pluck('count')->toArray()) !!},
                backgroundColor: [colors.primary, colors.success, colors.warning, colors.info],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Browser Chart
    const browserCtx = document.getElementById('browserChart').getContext('2d');
    new Chart(browserCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($browserStats->pluck('browser')->toArray()) !!},
            datasets: [{
                label: 'Visitors',
                data: {!! json_encode($browserStats->pluck('count')->toArray()) !!},
                backgroundColor: [colors.primary, colors.success, colors.warning, colors.info, colors.purple],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Platform Chart
    const platformCtx = document.getElementById('platformChart').getContext('2d');
    new Chart(platformCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($platformStats->pluck('platform')->toArray()) !!},
            datasets: [{
                label: 'Visitors',
                data: {!! json_encode($platformStats->pluck('count')->toArray()) !!},
                backgroundColor: [colors.info, colors.purple, colors.pink, colors.success, colors.warning],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});
</script>
@endsection
