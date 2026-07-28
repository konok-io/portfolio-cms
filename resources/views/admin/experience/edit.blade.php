@extends('admin.layouts.app')

@section('title', 'Edit Experience')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Edit Experience</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.experience.index') }}">Experience</a> / Edit</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.experience.update', $experience) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.experience._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Update Experience</button>
                <a href="{{ route('admin.experience.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
