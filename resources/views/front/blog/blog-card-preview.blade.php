<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Card Designs Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f8fafc; padding: 40px 20px; font-family: 'Segoe UI', system-ui, sans-serif; }
        .design-section { margin-bottom: 80px; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .design-header { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #e5e7eb; display: flex; align-items: baseline; gap: 20px; }
        .design-number { font-size: 3rem; font-weight: 800; color: #e5e7eb; line-height: 1; }
        .design-title { font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0; }
        
        /* Design 1 - Classic */
        .blog-card-1 { border-radius: 16px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.3s ease; height: 100%; }
        .blog-card-1:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: transparent; }
        .blog-card-1 .blog-img-wrap { aspect-ratio: 16/10; overflow: hidden; }
        .blog-card-1 .blog-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .blog-card-1:hover .blog-img-wrap img { transform: scale(1.05); }
        .blog-card-1 .category-badge { background: rgba(37, 99, 235, 0.1); color: #2563eb; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
        .blog-card-1 .category-badge:hover { background: #2563eb; color: #fff; }
        .blog-card-1 .blog-date { font-size: 0.8rem; color: #6b7280; }
        .blog-card-1 .blog-title { font-weight: 700; line-height: 1.4; }
        .blog-card-1 .blog-title a { color: #1f2937; text-decoration: none; }
        .blog-card-1 .blog-title a:hover { color: #2563eb; }
        .blog-card-1 .blog-excerpt { color: #6b7280; font-size: 0.9rem; line-height: 1.6; }
        .blog-card-1 .tag-pill { background: #f3f4f6; color: #6b7280; padding: 3px 10px; border-radius: 15px; font-size: 0.7rem; text-decoration: none; margin-right: 6px; }
        .blog-card-1 .tag-pill:hover { background: #e5e7eb; }
        .blog-card-1 .read-more-link { color: #2563eb; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        
        /* Design 2 - Horizontal */
        .blog-card-2 { border-radius: 16px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.3s ease; height: 100%; }
        .blog-card-2:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .blog-card-2 .blog-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .blog-card-2:hover .blog-img-wrap img { transform: scale(1.08); }
        .blog-card-2 .category-badge { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
        .blog-card-2 .blog-title a { color: #1f2937; text-decoration: none; }
        .blog-card-2 .blog-title a:hover { color: #2563eb; }
        .blog-card-2 .blog-excerpt { color: #6b7280; font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .blog-card-2 .read-more-link { color: #2563eb; font-weight: 600; text-decoration: none; }
        
        /* Design 3 - Minimal Text */
        .blog-card-3 { border-radius: 16px; background: #fff; border: 1px solid #e5e7eb; transition: all 0.3s ease; position: relative; overflow: hidden; }
        .blog-card-3::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: linear-gradient(180deg, #2563eb, #1d4ed8); opacity: 0; transition: opacity 0.3s ease; }
        .blog-card-3:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .blog-card-3:hover::before { opacity: 1; }
        .blog-card-3 .card-inner { padding: 24px; padding-left: 28px; }
        .blog-card-3 .category-badge { background: rgba(37, 99, 235, 0.1); color: #2563eb; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
        .blog-card-3 .blog-title a { color: #1f2937; text-decoration: none; }
        .blog-card-3 .blog-title a:hover { color: #2563eb; }
        .blog-card-3 .read-more-link { color: #2563eb; font-weight: 600; text-decoration: none; }
        
        /* Design 4 - Overlay */
        .blog-card-4 { border-radius: 16px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.3s ease; height: 100%; }
        .blog-card-4:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .blog-card-4 .blog-img-wrap { position: relative; aspect-ratio: 4/3; }
        .blog-card-4 .blog-img-wrap > img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .blog-card-4:hover .blog-img-wrap > img { transform: scale(1.1); }
        .blog-card-4 .blog-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.95) 100%); opacity: 0; transition: opacity 0.4s ease; display: flex; align-items: flex-end; }
        .blog-card-4:hover .blog-overlay { opacity: 1; }
        .blog-card-4 .overlay-content { padding: 24px; color: #fff; width: 100%; }
        .blog-card-4 .category-badge { background: #fff; color: #2563eb; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
        .blog-card-4 .blog-date { font-size: 0.8rem; color: rgba(255,255,255,0.8); }
        .blog-card-4 .blog-title a { color: #fff; text-decoration: none; }
        .blog-card-4 .blog-excerpt { color: rgba(255,255,255,0.9); font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .blog-card-4 .read-more-link { color: #fff; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        
        /* Design 5 - Side Accent */
        .blog-card-5 { border-radius: 12px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.3s ease; position: relative; height: 100%; }
        .blog-card-5 .card-accent { position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: linear-gradient(180deg, #10b981, #059669); transform: scaleY(0); transform-origin: top; transition: transform 0.3s ease; }
        .blog-card-5:hover { transform: translateY(-3px) translateX(5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .blog-card-5:hover .card-accent { transform: scaleY(1); }
        .blog-card-5 .blog-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .blog-card-5:hover .blog-img-wrap img { transform: scale(1.1); }
        .blog-card-5 .category-badge { background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 2px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; text-decoration: none; }
        .blog-card-5 .category-badge:hover { background: #10b981; color: #fff; }
        .blog-card-5 .blog-title a { color: #1f2937; text-decoration: none; }
        .blog-card-5 .blog-title a:hover { color: #10b981; }
        .blog-card-5 .blog-excerpt { color: #6b7280; font-size: 0.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        
        /* Design 6 - Magazine */
        .blog-card-6 { border-radius: 20px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.4s ease; height: 100%; }
        .blog-card-6:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.12); }
        .blog-card-6 .blog-img-wrap { position: relative; aspect-ratio: 16/10; }
        .blog-card-6 .blog-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .blog-card-6:hover .blog-img-wrap img { transform: scale(1.1); }
        .blog-card-6 .category-badge { position: absolute; top: 16px; left: 16px; background: #ef4444; color: #fff; padding: 6px 14px; border-radius: 25px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
        .blog-card-6 .blog-title a { color: #1f2937; text-decoration: none; }
        .blog-card-6 .blog-title a:hover { color: #2563eb; }
        .blog-card-6 .author-avatar { width: 32px; height: 32px; border-radius: 50%; background: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #6b7280; }
        .blog-card-6 .read-more-link { color: #2563eb; font-weight: 600; text-decoration: none; }
        
        /* Design 7 - Rounded Pill */
        .blog-card-7 { border-radius: 32px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%; }
        .blog-card-7:hover { transform: translateY(-12px) scale(1.02); box-shadow: 0 25px 50px rgba(99, 102, 241, 0.15); border-color: #6366f1; }
        .blog-card-7 .blog-img-wrap { position: relative; aspect-ratio: 1/1; overflow: hidden; border-radius: 24px 24px 0 0; }
        .blog-card-7 .blog-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .blog-card-7:hover .blog-img-wrap img { transform: scale(1.1); }
        .blog-card-7 .category-badge { position: absolute; top: 12px; right: 12px; background: #6366f1; color: #fff; padding: 6px 16px; border-radius: 25px; font-size: 0.75rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4); }
        .blog-card-7 .blog-title a { color: #1e1b4b; text-decoration: none; }
        .blog-card-7 .blog-title a:hover { color: #6366f1; }
        .blog-card-7 .read-more-btn { display: inline-flex; align-items: center; justify-content: center; width: 100%; padding: 12px 24px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border-radius: 25px; font-weight: 600; font-size: 0.85rem; text-decoration: none; transition: all 0.3s ease; }
        .blog-card-7 .read-more-btn:hover { background: linear-gradient(135deg, #4f46e5, #7c3aed); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4); }
        
        /* Design 8 - Image Focus */
        .blog-card-8 { border-radius: 16px; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; transition: all 0.4s ease; height: 100%; }
        .blog-card-8:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.15); }
        .blog-card-8 .blog-img-wrap { position: relative; aspect-ratio: 16/12; }
        .blog-card-8 .blog-img-wrap > img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
        .blog-card-8:hover .blog-img-wrap > img { transform: scale(1.15); }
        .blog-card-8 .img-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.6) 100%); opacity: 0; transition: opacity 0.4s ease; display: flex; align-items: flex-end; }
        .blog-card-8:hover .img-overlay { opacity: 1; }
        .blog-card-8 .category-badge { background: #f59e0b; color: #fff; padding: 5px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
        .blog-card-8 .blog-title a { color: #1f2937; text-decoration: none; }
        .blog-card-8 .blog-title a:hover { color: #f59e0b; }
        .blog-card-8 .read-more-link { display: inline-flex; align-items: center; gap: 8px; color: #f59e0b; font-weight: 700; text-decoration: none; }
        
        /* Design 9 - Dark Card */
        .blog-card-9 { border-radius: 20px; overflow: hidden; background: linear-gradient(145deg, #1e293b, #0f172a); border: 1px solid #334155; transition: all 0.4s ease; height: 100%; }
        .blog-card-9:hover { transform: translateY(-10px) rotateX(2deg); box-shadow: 0 30px 60px rgba(0,0,0,0.4); border-color: #475569; }
        .blog-card-9 .blog-img-wrap { position: relative; aspect-ratio: 16/9; }
        .blog-card-9 .blog-img-wrap > img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .blog-card-9:hover .blog-img-wrap > img { transform: scale(1.1); }
        .blog-card-9 .img-gradient { position: absolute; bottom: 0; left: 0; width: 100%; height: 60%; background: linear-gradient(to top, rgba(15, 23, 42, 0.9), transparent); }
        .blog-card-9 .category-badge { position: absolute; top: 16px; left: 16px; background: linear-gradient(135deg, #06b6d4, #0891b2); color: #fff; padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; z-index: 2; }
        .blog-card-9 .blog-date { position: absolute; bottom: 16px; right: 16px; font-size: 0.8rem; color: rgba(255,255,255,0.8); z-index: 2; }
        .blog-card-9 .blog-title a { color: #f1f5f9; text-decoration: none; }
        .blog-card-9 .blog-title a:hover { color: #06b6d4; }
        .blog-card-9 .blog-excerpt { color: #94a3b8; font-size: 0.85rem; }
        .blog-card-9 .read-more-btn { background: linear-gradient(135deg, #06b6d4, #0891b2); color: #fff; padding: 8px 20px; border-radius: 25px; font-weight: 600; font-size: 0.8rem; text-decoration: none; transition: all 0.3s ease; }
        .blog-card-9 .share-icon { width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #94a3b8; cursor: pointer; transition: all 0.3s ease; }
        .blog-card-9 .share-icon:hover { background: #06b6d4; color: #fff; }
        
        /* Design 10 - Gradient Border */
        .blog-card-10 { padding: 4px; background: linear-gradient(135deg, #2563eb, #7c3aed, #ec4899, #2563eb); background-size: 300% 300%; animation: gradientMove 8s ease infinite; border-radius: 24px; transition: all 0.4s ease; height: 100%; }
        @keyframes gradientMove { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .blog-card-10:hover { transform: translateY(-8px); box-shadow: 0 25px 50px rgba(37, 99, 235, 0.3); }
        .blog-card-10 .gradient-border { background: #fff; border-radius: 20px; overflow: hidden; height: 100%; }
        .blog-card-10 .blog-img-wrap { position: relative; aspect-ratio: 16/10; }
        .blog-card-10 .blog-img-wrap > img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .blog-card-10:hover .blog-img-wrap > img { transform: scale(1.08); }
        .blog-card-10 .category-badge { position: absolute; top: 16px; left: 16px; background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff; padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
        .blog-card-10 .blog-title a { color: #1f2937; text-decoration: none; transition: all 0.3s ease; }
        .blog-card-10 .blog-title a:hover { background: linear-gradient(135deg, #2563eb, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .blog-card-10 .read-more-link { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #2563eb, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 700; text-decoration: none; }
        
        @media (max-width: 768px) {
            .design-header { flex-wrap: wrap; gap: 10px; }
            .design-number { font-size: 2rem; width: 100%; }
            .design-title { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-2">🎨 Blog Card Design Collection</h1>
        <p class="text-center text-muted mb-5">10 beautiful blog card designs with hover effects</p>
        
        <!-- Design 1 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">01</span>
                <h2 class="design-title">Classic Card</h2>
            </div>
            <p class="text-muted mb-4">Standard card with image top, content below. Clean and familiar.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-1">
                        <div class="blog-img-wrap">
                            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400" alt="Blog">
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="#" class="category-badge">Laravel</a>
                                <span class="blog-date">Jul 27, 2026</span>
                            </div>
                            <h5 class="blog-title mb-3"><a href="#">Getting Started with Laravel 10</a></h5>
                            <p class="blog-excerpt">Learn the fundamentals of Laravel 10 and build your first web application.</p>
                            <div class="mb-3">
                                <a href="#" class="tag-pill">PHP</a>
                                <a href="#" class="tag-pill">Tutorial</a>
                            </div>
                            <a href="#" class="read-more-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 2 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">02</span>
                <h2 class="design-title">Horizontal Card</h2>
            </div>
            <p class="text-muted mb-4">Image on the left, content on the right. Great for list views.</p>
            <div class="row">
                <div class="col-lg-6">
                    <div class="blog-card-2">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="blog-img-wrap h-100">
                                    <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=600&h=400" alt="Blog">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="p-4 d-flex flex-column justify-content-center h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <a href="#" class="category-badge">React</a>
                                        <span class="blog-date">Jul 27, 2026</span>
                                    </div>
                                    <h5 class="blog-title mb-3"><a href="#">Building Modern Web Apps with React</a></h5>
                                    <p class="blog-excerpt">Discover how to build responsive web applications using React.</p>
                                    <a href="#" class="read-more-link mt-3">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 3 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">03</span>
                <h2 class="design-title">Minimal Text Card</h2>
            </div>
            <p class="text-muted mb-4">No image, text-focused design with left accent border.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-3">
                        <div class="card-inner">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="#" class="category-badge">Tips</a>
                                <span class="blog-date">Jul 27, 2026</span>
                            </div>
                            <h5 class="blog-title mb-3"><a href="#">10 Tips for Better Code Quality</a></h5>
                            <p class="blog-excerpt">Improve your coding skills with these essential tips for writing cleaner code.</p>
                            <a href="#" class="read-more-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 4 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">04</span>
                <h2 class="design-title">Overlay Card</h2>
            </div>
            <p class="text-muted mb-4">Image with overlay content that reveals on hover.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-4">
                        <div class="blog-img-wrap">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=400" alt="Blog">
                            <div class="blog-overlay">
                                <div class="overlay-content">
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="#" class="category-badge">CSS</a>
                                        <span class="blog-date">Jul 27</span>
                                    </div>
                                    <h5 class="blog-title mb-2"><a href="#">Mastering CSS Grid Layout</a></h5>
                                    <p class="blog-excerpt">A complete guide to CSS Grid including practical examples.</p>
                                    <a href="#" class="read-more-link mt-3">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 5 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">05</span>
                <h2 class="design-title">Side Accent Card</h2>
            </div>
            <p class="text-muted mb-4">Compact horizontal card with green accent on hover.</p>
            <div class="row">
                <div class="col-lg-6">
                    <div class="blog-card-5">
                        <div class="card-accent"></div>
                        <div class="row g-0">
                            <div class="col-4">
                                <div class="blog-img-wrap h-100">
                                    <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=300&h=200" alt="Blog">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="p-3 d-flex flex-column justify-content-center h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <a href="#" class="category-badge">Node.js</a>
                                        <span class="blog-date">Jul 27</span>
                                    </div>
                                    <h6 class="blog-title mb-2"><a href="#">Node.js Performance Optimization</a></h6>
                                    <p class="blog-excerpt">Learn how to optimize your Node.js applications.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 6 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">06</span>
                <h2 class="design-title">Magazine Style</h2>
            </div>
            <p class="text-muted mb-4">Feature-rich card with author info, read time, and elevated shadow.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-6">
                        <div class="blog-img-wrap">
                            <a href="#" class="category-badge">AI</a>
                            <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&h=400" alt="Blog">
                        </div>
                        <div class="p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="blog-date"><i class="fa-regular fa-calendar me-1"></i>Jul 27, 2026</span>
                                <span class="blog-date ms-3"><i class="fa-regular fa-clock me-1"></i>5 min read</span>
                            </div>
                            <h5 class="blog-title mb-3"><a href="#">The Future of Artificial Intelligence</a></h5>
                            <p class="blog-excerpt">Explore how AI is shaping the future of technology.</p>
                            <div class="d-flex align-items-center mt-3">
                                <div class="author-avatar me-2"><i class="fa-solid fa-user"></i></div>
                                <span class="blog-date">Author</span>
                                <a href="#" class="read-more-link ms-auto">Read <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 7 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">07</span>
                <h2 class="design-title">Rounded Pill Style</h2>
            </div>
            <p class="text-muted mb-4">Fully rounded corners with square image and pill-shaped button.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-7">
                        <div class="blog-img-wrap">
                            <img src="https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=600&h=400" alt="Blog">
                            <a href="#" class="category-badge">JavaScript</a>
                        </div>
                        <div class="p-4">
                            <span class="blog-date">Jul 27, 2026</span>
                            <h5 class="blog-title mt-2 mb-2"><a href="#">Modern JavaScript ES2024 Features</a></h5>
                            <p class="blog-excerpt">Stay ahead with the latest JavaScript features.</p>
                            <a href="#" class="read-more-btn mt-3">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 8 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">08</span>
                <h2 class="design-title">Image Focus Card</h2>
            </div>
            <p class="text-muted mb-4">Large image with overlay details that reveal on hover.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-8">
                        <div class="blog-img-wrap">
                            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600&h=400" alt="Blog">
                            <div class="img-overlay">
                                <div class="p-3">
                                    <a href="#" class="category-badge">Security</a>
                                    <div class="mt-3">
                                        <span class="blog-date">Jul 27, 2026</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h5 class="blog-title mb-2"><a href="#">Cybersecurity Best Practices for 2024</a></h5>
                            <p class="blog-excerpt">Protect your applications with these essential security practices.</p>
                            <a href="#" class="read-more-link mt-3">Read Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 9 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">09</span>
                <h2 class="design-title">Modern Dark Card</h2>
            </div>
            <p class="text-muted mb-4">Dark theme card with gradient background and cyan accents.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-9">
                        <div class="blog-img-wrap">
                            <img src="https://images.unsplash.com/photo-1605745341112-85968b19335b?w=600&h=400" alt="Blog">
                            <div class="img-gradient"></div>
                            <a href="#" class="category-badge">DevOps</a>
                            <span class="blog-date">Jul 27, 2026</span>
                        </div>
                        <div class="p-4">
                            <h5 class="blog-title mb-2"><a href="#">Docker Containerization Guide</a></h5>
                            <p class="blog-excerpt">Master Docker and containerize your applications for consistent deployments.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="#" class="read-more-btn">Read More</a>
                                <div class="share-icon"><i class="fa-solid fa-share-nodes"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design 10 -->
        <div class="design-section">
            <div class="design-header">
                <span class="design-number">10</span>
                <h2 class="design-title">Gradient Border Card</h2>
            </div>
            <p class="text-muted mb-4">Animated gradient border with text gradient effects.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card-10">
                        <div class="gradient-border">
                            <div class="blog-img-wrap">
                                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&h=400" alt="Blog">
                                <a href="#" class="category-badge">API</a>
                            </div>
                            <div class="p-4">
                                <span class="blog-date mb-2 d-block"><i class="fa-regular fa-calendar me-1"></i>Jul 27, 2026</span>
                                <h5 class="blog-title mb-2"><a href="#">GraphQL vs REST API Comparison</a></h5>
                                <p class="blog-excerpt">A comprehensive comparison between GraphQL and REST APIs.</p>
                                <a href="#" class="read-more-link mt-3">Continue Reading <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
