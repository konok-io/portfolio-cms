@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Services</h1>
        <p class="admin-breadcrumb mb-0">Manage the services offered, shown on your homepage.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-admin-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Service
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0" id="servicesTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><i class="{{ $service->icon ?? 'fa-solid fa-gear' }} text-primary fs-5"></i></td>
                        <td class="fw-semibold">{{ $service->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($service->description, 60) }}</td>
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success-subtle text-success">Active</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" data-confirm-delete="Delete this service?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function () { $('#servicesTable').DataTable({ order: [], pageLength: 25 }); });
</script>
@endpush
