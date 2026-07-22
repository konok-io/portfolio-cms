@extends('front.layouts.app')

@section('seo_title', 'Login')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="admin-card">
                    <div class="card-header-custom text-center">
                        <h4 class="mb-0"><i class="fa-solid fa-user-circle me-2"></i>Login</h4>
                    </div>
                    <div class="card-body-custom p-4">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="you@example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="••••••••">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100 mb-3">
                                <i class="fa-solid fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>
                        
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? <a href="{{ route('user.register') }}" class="text-primary-custom fw-semibold">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
