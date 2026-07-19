<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        body { font-family:'Inter',sans-serif; background:#f8fafc; min-height:100vh; display:flex; align-items:center; }
        h1 { font-family:'Plus Jakarta Sans',sans-serif; font-size:6rem; font-weight:800; color:#2563EB; }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>404</h1>
        <h4 class="mb-3">Page Not Found</h4>
        <p class="text-muted mb-4">The page you're looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2" style="background:#2563EB;border-color:#2563EB;">Back to Home</a>
    </div>
</body>
</html>
