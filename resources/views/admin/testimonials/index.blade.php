@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Testimonials</h1>
        <p class="admin-breadcrumb mb-0">Manage client reviews shown on your homepage.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-admin-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Testimonial
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Client</th>
                    <th>Company</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td><img src="{{ $testimonial->photo_url }}" class="thumb rounded-circle" alt="{{ $testimonial->client_name }}"></td>
                        <td class="fw-semibold">{{ $testimonial->client_name }}</td>
                        <td>{{ $testimonial->company }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= $testimonial->rating ? 'solid' : 'regular' }} fa-star text-warning small"></i>
                            @endfor
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($testimonial->review, 50) }}</td>
                        <td>
                            @if($testimonial->is_active)
                                <span class="badge bg-success-subtle text-success">Active</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" data-confirm-delete="Delete this testimonial?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No testimonials yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
        <div class="p-3">{{ $testimonials->links() }}</div>
    @endif
</div>

@endsection
