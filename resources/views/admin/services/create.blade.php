@extends('admin.layouts.app')

@section('title', 'Add Service')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Add Service</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.services.index') }}">Services</a> / Add New</p>
    </div>
</div>

<x-validation-errors />

<div class="admin-card">
    <div class="card-body-custom">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            @include('admin.services._form')
            <div class="mt-4">
                <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Save Service</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
