<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        body { font-family:'Inter',sans-serif; background:#f8fafc; min-height:100vh; display:flex; align-items:center; }
        h1 { font-size:5rem; font-weight:800; color:#dc2626; }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>500</h1>
        <h4 class="mb-3">Server Error</h4>
        <p class="text-muted mb-2">Something went wrong on our end.</p>
        <p class="text-muted small mb-4">
            If you just installed the project, make sure you ran:<br>
            <code>php artisan key:generate</code> &nbsp;&amp;&amp;&nbsp;
            <code>php artisan migrate --seed</code> &nbsp;&amp;&amp;&nbsp;
            <code>php artisan storage:link</code>
        </p>
        <a href="{{ url('/') }}" class="btn btn-primary px-4" style="background:#2563EB;border-color:#2563EB;">Try Again</a>
    </div>
</body>
</html>
