@extends('front.layouts.app')

@section('seo_title', 'Register')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="admin-card">
                    <div class="card-header-custom text-center">
                        <h4 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Create Account</h4>
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
                        
                        <form method="POST" action="{{ route('user.register') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="John Doe">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="you@example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat password">
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100 mb-3">
                                <i class="fa-solid fa-user-plus me-2"></i>Register
                            </button>
                        </form>
                        
                        <div class="text-center">
                            <p class="mb-0">Already have an account? <a href="{{ route('user.login') }}" class="text-primary-custom fw-semibold">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
