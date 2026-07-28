@extends('admin.layouts.app')

@section('title', 'Add Experience')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Add Experience</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.experience.index') }}">Experience</a> / Add New</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.experience.store') }}" method="POST">
            @csrf
            @include('admin.experience._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Save Experience</button>
                <a href="{{ route('admin.experience.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
