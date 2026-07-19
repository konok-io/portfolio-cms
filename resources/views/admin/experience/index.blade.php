@extends('admin.layouts.app')

@section('title', 'Experience')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Work Experience</h1>
        <p class="admin-breadcrumb mb-0">Manage your professional work history timeline.</p>
    </div>
    <a href="{{ route('admin.experience.create') }}" class="btn btn-admin-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Experience
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0" id="experienceTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Designation</th>
                    <th>Duration</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($experiences as $experience)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $experience->company_name }}</td>
                        <td>{{ $experience->designation }}</td>
                        <td>{{ $experience->duration }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.experience.edit', $experience) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.experience.destroy', $experience) }}" method="POST" class="d-inline" data-confirm-delete="Delete this experience entry?">
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
    $(function () { $('#experienceTable').DataTable({ order: [], pageLength: 25 }); });
</script>
@endpush
