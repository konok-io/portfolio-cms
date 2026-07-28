@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Edit Service</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.services.index') }}">Services</a> / Edit</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.services._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Update Service</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
