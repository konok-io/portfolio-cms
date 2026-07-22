@extends('front.layouts.app')

@section('seo_title', 'Client Portal Access')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <i class="fa-solid fa-user-shield fa-4x text-primary-custom"></i>
                    </div>
                    <h1 class="section-title">Client Portal</h1>
                    <p class="lead text-muted">Enter your access token to view your project status and files.</p>
                </div>

                <div class="admin-card">
                    <div class="card-body-custom p-4">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->has('token'))
                            <div class="alert alert-danger">{{ $errors->first('token') }}</div>
                        @endif

                        <form method="POST" action="{{ route('client-portal.verify') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Access Token</label>
                                <input type="text" name="token" class="form-control" required placeholder="Enter your access token" value="{{ request('token') }}">
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="fa-solid fa-sign-in-alt me-2"></i>Access Portal
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted small">
                        Don't have an access token? Contact the project manager.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
