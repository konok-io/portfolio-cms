@extends('admin.layouts.app')

@section('title', 'Skills')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Skills</h1>
        <p class="admin-breadcrumb mb-0">Manage the skills shown on your homepage progress bars.</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-admin-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Skill
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0" id="skillsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Percentage</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skills as $skill)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($skill->icon)<i class="{{ $skill->icon }} me-2 text-primary"></i>@endif
                            {{ $skill->name }}
                        </td>
                        <td>
                            <div class="progress" style="height: 8px; width: 120px;">
                                <div class="progress-bar bg-primary" style="width: {{ $skill->percentage }}%"></div>
                            </div>
                            <small class="text-muted">{{ $skill->percentage }}%</small>
                        </td>
                        <td>{{ $skill->sort_order }}</td>
                        <td>
                            @if($skill->is_active)
                                <span class="badge bg-success-subtle text-success">Active</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline" data-confirm-delete="Delete this skill? This cannot be undone.">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
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
    $(function () {
        $('#skillsTable').DataTable({ order: [], pageLength: 25 });
    });
</script>
@endpush
