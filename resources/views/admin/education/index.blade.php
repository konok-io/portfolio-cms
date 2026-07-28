@extends('admin.layouts.app')

@section('title', 'Education')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Education</h1>
        <p class="admin-breadcrumb mb-0">Manage your academic background timeline.</p>
    </div>
    <a href="{{ route('admin.education.create') }}" class="btn btn-admin-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Education
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0" id="educationTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Institute</th>
                    <th>Degree</th>
                    <th>Duration</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($educations as $education)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $education->institute_name }}</td>
                        <td>{{ $education->degree }}</td>
                        <td>{{ $education->duration }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.education.edit', $education) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.education.destroy', $education) }}" method="POST" class="d-inline" data-confirm-delete="Delete this education entry?">
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
    $(function () { $('#educationTable').DataTable({ order: [], pageLength: 25 }); });
</script>
@endpush
