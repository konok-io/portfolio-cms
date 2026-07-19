@extends('admin.layouts.app')

@section('title', 'Edit Skill')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Edit Skill</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.skills.index') }}">Skills</a> / Edit</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.skills._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Update Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
