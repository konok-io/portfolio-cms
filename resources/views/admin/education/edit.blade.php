@extends('admin.layouts.app')

@section('title', 'Edit Education')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Edit Education</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.education.index') }}">Education</a> / Edit</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.education.update', $education) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.education._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Update Education</button>
                <a href="{{ route('admin.education.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
