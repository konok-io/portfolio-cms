<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #2563EB;
            --secondary: #1e293b;
            --accent: #3b82f6;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
        }
        .error-container {
            text-align: center;
            padding: 2rem;
        }
        .error-code {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 8rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 4px 4px 0 rgba(37, 99, 235, 0.1);
        }
        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 1rem;
        }
        .error-message {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-home {
            background: var(--primary);
            border: none;
            padding: 0.875rem 2rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-home:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
            color: white;
        }
        .illustration {
            font-size: 5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="error-container">
                    <div class="illustration">
                        <i class="fas fa-compass"></i>
                    </div>
                    <div class="error-code">404</div>
                    <h1 class="error-title">Page Not Found</h1>
                    <p class="error-message">
                        Oops! The page you're looking for doesn't exist or has been moved.
                    </p>
                    <a href="{{ url('/') }}" class="btn-home">
                        <i class="fas fa-home"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
