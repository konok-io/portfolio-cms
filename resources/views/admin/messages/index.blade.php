@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Contact Messages</h1>
        <p class="admin-breadcrumb mb-0">Messages submitted through your website's contact form.</p>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Received</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ !$message->is_read ? 'fw-semibold' : '' }}">
                        <td>
                            @if(!$message->is_read)
                                <span class="badge bg-danger">New</span>
                            @endif
                        </td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($message->subject ?: $message->message, 35) }}</td>
                        <td>{{ $message->created_at->diffForHumans() }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i></a>
                            @if($message->is_read)
                                <form action="{{ route('admin.messages.unread', $message) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Mark Unread"><i class="fa-regular fa-envelope"></i></button>
                                </form>
                            @else
                                <form action="{{ route('admin.messages.read', $message) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Mark Read"><i class="fa-solid fa-envelope-open"></i></button>
                                </form>
                            @endif
                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" data-confirm-delete="Delete this message?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
        <div class="p-3">{{ $messages->links() }}</div>
    @endif
</div>

@endsection
