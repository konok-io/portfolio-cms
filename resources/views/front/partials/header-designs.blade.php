{{-- =========================================================
     HEADER DESIGN OPTIONS
     Choose any design and implement dynamically
     ========================================================= --}}

{{-- =========================================================
     DESIGN 1: Minimal Clean (Current Style)
     ========================================================= --}}
<style>
/* Design 1: Minimal Clean */
.header-design-1 {
    background: #ffffff;
    border-bottom: 1px solid #d1d5db;
    padding: 1rem 0;
}
.header-design-1 .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: #1a1a2e;
}
.header-design-1 .nav-link {
    color: #4b5563;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: color 0.3s;
}
.header-design-1 .nav-link:hover,
.header-design-1 .nav-link.active {
    color: #2563EB;
}
</style>

{{-- =========================================================
     DESIGN 2: Modern Glassmorphism
     ========================================================= --}}
<style>
/* Design 2: Modern Glassmorphism */
.header-design-2 {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}
.header-design-2 .navbar-brand {
    font-weight: 800;
    font-size: 1.75rem;
    background: linear-gradient(135deg, #2563EB, #2563eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.header-design-2 .nav-link {
    color: #374151;
    font-weight: 500;
    padding: 0.5rem 1rem;
    position: relative;
}
.header-design-2 .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background: #2563EB;
    transition: width 0.3s;
}
.header-design-2 .nav-link:hover::after,
.header-design-2 .nav-link.active::after {
    width: 60%;
}
.header-design-2 .nav-link:hover,
.header-design-2 .nav-link.active {
    color: #2563EB;
}
.header-design-2 .theme-toggle-btn,
.header-design-2 .gt-btn {
    background: rgba(37, 99, 235, 0.1);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}
.header-design-2 .theme-toggle-btn:hover,
.header-design-2 .gt-btn:hover {
    background: #2563EB;
    color: #fff;
}
</style>

{{-- =========================================================
     DESIGN 3: Bold with Underline Animation
     ========================================================= --}}
<style>
/* Design 3: Bold with Underline Animation */
.header-design-3 {
    background: #ffffff;
    border-bottom: 3px solid #2563EB;
    padding: 0.75rem 0;
}
.header-design-3 .navbar-brand {
    font-weight: 900;
    font-size: 1.6rem;
    color: #1a1a2e;
    letter-spacing: -0.5px;
}
.header-design-3 .nav-link {
    color: #1a1a2e;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 0.5rem 1.25rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
}
.header-design-3 .nav-link::before {
    content: '';
    position: absolute;
    bottom: -0.75rem;
    left: 0;
    width: 100%;
    height: 3px;
    background: #2563EB;
    transform: scaleX(0);
    transition: transform 0.3s;
}
.header-design-3 .nav-link:hover::before,
.header-design-3 .nav-link.active::before {
    transform: scaleX(1);
}
.header-design-3 .nav-link:hover,
.header-design-3 .nav-link.active {
    color: #2563EB;
}
</style>

{{-- =========================================================
     DESIGN 4: Soft Rounded Pills
     ========================================================= --}}
<style>
/* Design 4: Soft Rounded Pills */
.header-design-4 {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 1rem 0;
}
.header-design-4 .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: #2563EB;
}
.header-design-4 .nav-link {
    color: #64748b;
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    transition: all 0.3s;
}
.header-design-4 .nav-link:hover,
.header-design-4 .nav-link.active {
    color: #2563EB;
    background: rgba(37, 99, 235, 0.1);
}
</style>

{{-- =========================================================
     DESIGN 5: Split Layout (Logo Left, Links Center)
     ========================================================= --}}
<style>
/* Design 5: Split Layout */
.header-design-5 {
    background: #ffffff;
    border-bottom: 1px solid #d1d5db;
    padding: 1.25rem 0;
}
.header-design-5 .navbar-brand {
    font-weight: 800;
    font-size: 1.6rem;
    color: #1a1a2e;
}
.header-design-5 .nav-container {
    display: flex;
    justify-content: center;
}
.header-design-5 .nav-link {
    color: #4b5563;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
    position: relative;
}
.header-design-5 .nav-link::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    background: #2563EB;
    border-radius: 50%;
    opacity: 0;
    transition: all 0.3s;
}
.header-design-5 .nav-link:hover::after,
.header-design-5 .nav-link.active::after {
    opacity: 1;
}
.header-design-5 .nav-link:hover,
.header-design-5 .nav-link.active {
    color: #2563EB;
}
</style>

{{-- =========================================================
     DESIGN 6: Gradient Border Bottom
     ========================================================= --}}
<style>
/* Design 6: Gradient Border Bottom */
.header-design-6 {
    background: rgba(255, 255, 255, 0.98);
    border-bottom: none;
    padding: 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}
.header-design-6 .nav-wrapper {
    border-bottom: 4px solid;
    border-image: linear-gradient(90deg, #2563EB, #2563eb, #2563EB) 1;
}
.header-design-6 .navbar-brand {
    font-weight: 800;
    font-size: 1.6rem;
    color: #1a1a2e;
}
.header-design-6 .nav-link {
    color: #4b5563;
    font-weight: 600;
    padding: 1.25rem 1rem;
    transition: all 0.3s;
}
.header-design-6 .nav-link:hover,
.header-design-6 .nav-link.active {
    color: #2563EB;
    background: rgba(37, 99, 235, 0.05);
}
</style>

{{-- =========================================================
     DESIGN 7: Dark Professional
     ========================================================= --}}
<style>
/* Design 7: Dark Professional */
.header-design-7 {
    background: #0F172A;
    border-bottom: 1px solid #1e293b;
    padding: 1rem 0;
}
.header-design-7 .navbar-brand {
    font-weight: 800;
    font-size: 1.6rem;
    color: #ffffff;
}
.header-design-7 .nav-link {
    color: #94a3b8;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.3s;
}
.header-design-7 .nav-link:hover,
.header-design-7 .nav-link.active {
    color: #60a5fa;
}
.header-design-7 .theme-toggle-btn,
.header-design-7 .gt-btn {
    background: #1e293b;
    border: 1px solid #334155;
    color: #94a3b8;
}
.header-design-7 .theme-toggle-btn:hover,
.header-design-7 .gt-btn:hover {
    background: #2563EB;
    border-color: #2563EB;
    color: #fff;
}
</style>

{{-- =========================================================
     DESIGN 8: Minimal with Dot Indicator
     ========================================================= --}}
<style>
/* Design 8: Minimal with Dot Indicator */
.header-design-8 {
    background: #ffffff;
    border-bottom: 1px solid #f1f5f9;
    padding: 1.25rem 0;
}
.header-design-8 .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: #1a1a2e;
}
.header-design-8 .nav-link {
    color: #64748b;
    font-weight: 500;
    padding: 0.5rem 1rem;
}
.header-design-8 .nav-item {
    position: relative;
}
.header-design-8 .nav-item::before {
    content: '';
    position: absolute;
    top: 50%;
    left: -8px;
    transform: translateY(-50%);
    width: 4px;
    height: 4px;
    background: #2563EB;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s;
}
.header-design-8 .nav-link:hover,
.header-design-8 .nav-link.active {
    color: #2563EB;
}
.header-design-8 .nav-link:hover ~ .nav-item::before,
.header-design-8 .nav-link.active ~ .nav-item::before {
    opacity: 1;
}
</style>

{{-- =========================================================
     DESIGN 9: Floating Card Style
     ========================================================= --}}
<style>
/* Design 9: Floating Card Style */
.header-design-9 {
    background: transparent;
    padding: 1.5rem 0;
}
.header-design-9 .nav-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    padding: 0.75rem 1.5rem;
}
.header-design-9 .navbar-brand {
    font-weight: 800;
    font-size: 1.5rem;
    background: linear-gradient(135deg, #2563EB, #2563eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.header-design-9 .nav-link {
    color: #4b5563;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: color 0.3s;
}
.header-design-9 .nav-link:hover,
.header-design-9 .nav-link.active {
    color: #2563EB;
}
</style>

{{-- =========================================================
     DESIGN 10: Corporate Enterprise
     ========================================================= --}}
<style>
/* Design 10: Corporate Enterprise */
.header-design-10 {
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border-bottom: 1px solid #e2e8f0;
    padding: 0.5rem 0;
}
.header-design-10 .navbar-brand {
    font-weight: 700;
    font-size: 1.4rem;
    color: #0F172A;
}
.header-design-10 .navbar-brand span {
    color: #2563EB;
}
.header-design-10 .nav-link {
    color: #475569;
    font-weight: 500;
    font-size: 0.9rem;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.2s;
}
.header-design-10 .nav-link:hover {
    color: #2563EB;
    background: rgba(37, 99, 235, 0.05);
}
.header-design-10 .nav-link.active {
    color: #2563EB;
    background: rgba(37, 99, 235, 0.1);
    font-weight: 600;
}
.header-design-10 .action-buttons {
    display: flex;
    gap: 0.5rem;
}
.header-design-10 .btn-contact {
    background: #2563EB;
    color: #fff;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
}
.header-design-10 .btn-contact:hover {
    background: #1d4ed8;
    color: #fff;
    transform: translateY(-1px);
}
</style>

{{-- =========================================================
     HTML PREVIEWS
     ========================================================= --}}

<!-- ========== DESIGN 1 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 1: Minimal Clean</h3>
    <nav class="navbar navbar-expand-lg header-design-1">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 2 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 2: Modern Glassmorphism</h3>
    <nav class="navbar navbar-expand-lg header-design-2">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 3 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 3: Bold with Underline Animation</h3>
    <nav class="navbar navbar-expand-lg header-design-3">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 4 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 4: Soft Rounded Pills</h3>
    <nav class="navbar navbar-expand-lg header-design-4">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 5 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 5: Split Layout</h3>
    <nav class="navbar navbar-expand-lg header-design-5">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 6 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 6: Gradient Border Bottom</h3>
    <nav class="navbar navbar-expand-lg header-design-6">
        <div class="container nav-wrapper">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 7 PREVIEW ========== -->
<div class="demo-section" style="background: #0F172A; padding: 20px;">
    <h3 style="color: #fff;">Design 7: Dark Professional</h3>
    <nav class="navbar navbar-expand-lg header-design-7">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 8 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 8: Minimal with Dot Indicator</h3>
    <nav class="navbar navbar-expand-lg header-design-8">
        <div class="container">
            <a class="navbar-brand" href="#">YourBrand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 9 PREVIEW ========== -->
<div class="demo-section" style="background: linear-gradient(180deg, #f0f7ff 0%, #e8f4ff 100%); padding: 40px 20px;">
    <h3>Design 9: Floating Card Style</h3>
    <nav class="navbar navbar-expand-lg header-design-9">
        <div class="container">
            <div class="nav-card mx-auto w-100">
                <a class="navbar-brand" href="#">YourBrand</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<!-- ========== DESIGN 10 PREVIEW ========== -->
<div class="demo-section">
    <h3>Design 10: Corporate Enterprise</h3>
    <nav class="navbar navbar-expand-lg header-design-10">
        <div class="container">
            <a class="navbar-brand" href="#">Your<span>Brand</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
                <div class="action-buttons">
                    <a href="#" class="btn-contact">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<style>
.demo-section {
    margin-bottom: 40px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
}
.demo-section h3 {
    margin-bottom: 20px;
    color: #1a1a2e;
    font-weight: 600;
}
</style>
