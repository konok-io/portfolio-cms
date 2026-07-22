@extends('front.layouts.app')

@section('seo_title', 'Get a Quote')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Get a Quote</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="section-eyebrow">Get Started</span>
                    <h1 class="section-title">Request a Quote</h1>
                    <p class="lead text-muted">Tell us about your project and we'll get back to you within 24 hours.</p>
                </div>

                <div class="admin-card">
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

                        <form method="POST" action="{{ route('quote.store') }}">
                            @csrf

                            {{-- Service Selection --}}
                            <div class="mb-4">
                                <label class="form-label">Service You're Interested In <span class="text-muted">(Optional)</span></label>
                                <select name="service_id" class="form-select">
                                    <option value="">Select a service...</option>
                                    @foreach($services as $srv)
                                        <option value="{{ $srv->id }}" {{ old('service_id', $service?->id) == $srv->id ? 'selected' : '' }}>
                                            {{ $srv->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row g-3">
                                {{-- Name --}}
                                <div class="col-md-6">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="John Doe">
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="john@example.com">
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number <span class="text-muted">(Optional)</span></label>
                                    <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 234 567 890">
                                </div>

                                {{-- Company --}}
                                <div class="col-md-6">
                                    <label class="form-label">Company Name <span class="text-muted">(Optional)</span></label>
                                    <input type="text" name="company" class="form-control" value="{{ old('company') }}" placeholder="Your Company">
                                </div>

                                {{-- Budget --}}
                                <div class="col-12">
                                    <label class="form-label">Estimated Budget</label>
                                    <select name="budget" class="form-select">
                                        <option value="">Select budget range...</option>
                                        <option value="under_1k" {{ old('budget') == 'under_1k' ? 'selected' : '' }}>Under $1,000</option>
                                        <option value="1k_5k" {{ old('budget') == '1k_5k' ? 'selected' : '' }}>$1,000 - $5,000</option>
                                        <option value="5k_10k" {{ old('budget') == '5k_10k' ? 'selected' : '' }}>$5,000 - $10,000</option>
                                        <option value="10k_plus" {{ old('budget') == '10k_plus' ? 'selected' : '' }}>$10,000+</option>
                                        <option value="not_sure" {{ old('budget') == 'not_sure' ? 'selected' : '' }}>Not Sure Yet</option>
                                    </select>
                                </div>

                                {{-- Message --}}
                                <div class="col-12">
                                    <label class="form-label">Project Details *</label>
                                    <textarea name="message" class="form-control" rows="5" required placeholder="Tell us about your project, goals, timeline, and any specific requirements...">{{ old('message') }}</textarea>
                                    <small class="text-muted">Max 2000 characters</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary-custom w-100 mt-4">
                                <i class="fa-solid fa-paper-plane me-2"></i>Submit Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Services Preview --}}
        @if($services->isNotEmpty())
            <div class="mt-5">
                <h4 class="mb-4 text-center">Popular Services</h4>
                <div class="row g-3">
                    @foreach($services->take(3) as $srv)
                        <div class="col-md-4">
                            <a href="{{ route('services.show', $srv->slug) }}" class="text-decoration-none">
                                <div class="p-4 rounded-4 border h-100 service-preview-card">
                                    <h6><i class="fa-solid fa-check-circle text-success me-2"></i>{{ $srv->title }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit(strip_tags($srv->short_description ?: $srv->content), 80) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.service-preview-card {
    transition: all 0.3s ease;
}
.service-preview-card:hover {
    border-color: var(--color-primary) !important;
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
</style>
@endsection
