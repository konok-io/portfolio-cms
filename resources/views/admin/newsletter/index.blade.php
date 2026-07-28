@extends('admin.layouts.app')

@section('title', 'Newsletter Campaigns - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-envelope-open-text me-2 text-primary"></i>
                Newsletter Campaigns
            </h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.subscribers.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-users me-2"></i>Subscribers ({{ $subscribersCount }})
                </a>
                <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i>New Campaign
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($campaigns->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Subject</th>
                                <th style="width: 120px">Status</th>
                                <th style="width: 150px">Recipients</th>
                                <th style="width: 150px">Sent</th>
                                <th style="width: 180px">Date</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                                <tr>
                                    <td>
                                        <strong>{{ Str::limit($campaign->subject, 60) }}</strong>
                                    </td>
                                    <td>
                                        @switch($campaign->status)
                                            @case('draft')
                                                <span class="badge bg-secondary">Draft</span>
                                                @break
                                            @case('scheduled')
                                                <span class="badge bg-info">Scheduled</span>
                                                @break
                                            @case('sending')
                                                <span class="badge bg-warning">Sending...</span>
                                                @break
                                            @case('sent')
                                                <span class="badge bg-success">Sent</span>
                                                @break
                                            @case('failed')
                                                <span class="badge bg-danger">Failed</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ number_format($campaign->total_recipients) }}</td>
                                    <td>
                                        @if($campaign->status === 'sent')
                                            <span class="text-success">{{ number_format($campaign->successful_deliveries) }}</span>
                                            @if($campaign->failed_deliveries > 0)
                                                <small class="text-danger">({{ $campaign->failed_deliveries }} failed)</small>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($campaign->sent_at)
                                            <small>{{ $campaign->sent_at->format('M d, Y H:i') }}</small>
                                        @elseif($campaign->scheduled_at)
                                            <small class="text-info">{{ $campaign->scheduled_at->format('M d, Y H:i') }}</small>
                                        @else
                                            <small class="text-muted">{{ $campaign->created_at->format('M d, Y') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.newsletter.preview', $campaign) }}" class="btn btn-outline-secondary" title="Preview">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @if($campaign->status === 'draft' || $campaign->status === 'failed')
                                                <a href="{{ route('admin.newsletter.edit', $campaign) }}" class="btn btn-outline-primary" title="Edit">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.newsletter.send', $campaign) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success" title="Send" onclick="return confirm('Send this campaign to all subscribers?')">
                                                        <i class="fa-solid fa-paper-plane"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($campaign->status !== 'sending')
                                                <form action="{{ route('admin.newsletter.destroy', $campaign) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Delete this campaign?')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-envelope-open-text fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No campaigns yet. Create your first newsletter!</p>
                    <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>Create Campaign
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
