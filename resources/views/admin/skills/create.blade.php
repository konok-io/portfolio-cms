@extends('admin.layouts.app')

@section('title', 'Add Skill')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Add Skill</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.skills.index') }}">Skills</a> / Add New</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.skills.store') }}" method="POST">
            @csrf
            @include('admin.skills._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Save Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
