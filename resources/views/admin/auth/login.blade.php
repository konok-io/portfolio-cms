<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | {{ $siteSetting->site_name ?? 'Portfolio CMS' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <script>(function(){try{var t=localStorage.getItem('pc-theme')||'light';if(t==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}})();</script>
    <script>(function(){try{var m=document.cookie.match(/googtrans=\/[^\/]+\/([a-z-]+)/);var l=m?m[1]:'en';var rtl=['ar','ur','fa','he','ps','sd'];if(rtl.indexOf(l)>=0){document.documentElement.setAttribute('dir','rtl');}else{document.documentElement.setAttribute('dir','ltr');}}catch(e){}})();</script>
    <style>
      .login-home:hover{background:rgba(37,99,235,0.18)!important;transform:translateY(-2px)}
      [data-theme="dark"] body{background:#0A0A1F!important;color:#EDECFF}
      [data-theme="dark"] .admin-login-wrap{background:#0A0A1F!important}
      [data-theme="dark"] .admin-login-card{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .admin-login-card .text-muted{color:#9B98C7!important}
      [data-theme="dark"] .form-control{background:#0A0A1F;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .form-control::placeholder{color:#6B6790}
      [data-theme="dark"] .form-label,[data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4{color:#EDECFF}
    </style>
</head>
<body>
<div class="admin-login-wrap">
    <div class="admin-login-card">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3 login-home"
               style="width:56px;height:56px;background:rgba(37,99,235,0.1);text-decoration:none;transition:background .16s,transform .16s"
               aria-label="Back to home" title="Back to home">
                <i class="fa-solid fa-house fs-3 text-primary"></i>
            </a>
            <h4 class="fw-bold mb-1">Welcome Back</h4>
            <p class="text-muted small mb-0">Sign in to manage your portfolio</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger small">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label-admin">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label-admin">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
            </button>
        </form>
    </div>
</div>
</body>
</html>
