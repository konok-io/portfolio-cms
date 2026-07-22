{{-- Skeleton Loader Partial --}}
{{-- Usage: @include('front.partials.skeleton-loader', ['type' => 'cards', 'count' => 3]) --}}

@php
$type = $type ?? 'cards';
$count = $count ?? 3;
@endphp

<style>
.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

@keyframes skeleton-loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.skeleton-card {
    border-radius: 12px;
    overflow: hidden;
}

.skeleton-text {
    height: 1em;
    margin-bottom: 0.5em;
}

.skeleton-text:last-child {
    width: 70%;
}

.skeleton-title {
    height: 1.5em;
    width: 80%;
    margin-bottom: 0.75em;
}

.skeleton-image {
    aspect-ratio: 16/9;
    width: 100%;
}

.skeleton-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.skeleton-badge {
    height: 24px;
    width: 80px;
    border-radius: 12px;
}

.skeleton-btn {
    height: 40px;
    width: 120px;
    border-radius: 8px;
}
</style>

@if($type === 'cards')
    @for($i = 0; $i < $count; $i++)
        <div class="skeleton-card skeleton mb-3">
            <div class="skeleton-image"></div>
            <div style="padding: 1rem;">
                <div class="skeleton-badge skeleton mb-2"></div>
                <div class="skeleton-title skeleton"></div>
                <div class="skeleton-text skeleton"></div>
                <div class="skeleton-text skeleton"></div>
                <div class="d-flex gap-2 mt-3">
                    <div class="skeleton-btn skeleton"></div>
                    <div class="skeleton-btn skeleton" style="opacity: 0.7;"></div>
                </div>
            </div>
        </div>
    @endfor
@elseif($type === 'blog')
    @for($i = 0; $i < $count; $i++)
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="skeleton skeleton-image" style="aspect-ratio: 4/3;"></div>
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div style="width: 100%;">
                    <div class="skeleton-badge skeleton mb-2"></div>
                    <div class="skeleton-title skeleton"></div>
                    <div class="skeleton-text skeleton"></div>
                    <div class="skeleton-text skeleton"></div>
                </div>
            </div>
        </div>
    @endfor
@elseif($type === 'projects')
    @for($i = 0; $i < $count; $i++)
        <div class="col-md-6 col-lg-4">
            <div class="skeleton skeleton-card h-100">
                <div class="skeleton-image"></div>
                <div style="padding: 1rem;">
                    <div class="skeleton-title skeleton"></div>
                    <div class="skeleton-text skeleton"></div>
                    <div class="skeleton-text skeleton"></div>
                </div>
            </div>
        </div>
    @endfor
@elseif($type === 'services')
    @for($i = 0; $i < $count; $i++)
        <div class="col-md-6 col-lg-4">
            <div class="skeleton skeleton-card h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="skeleton-circle skeleton"></div>
                    <div style="flex: 1;">
                        <div class="skeleton-title skeleton" style="width: 60%;"></div>
                    </div>
                </div>
                <div class="skeleton-text skeleton"></div>
                <div class="skeleton-text skeleton"></div>
                <div class="skeleton-text skeleton" style="width: 50%;"></div>
            </div>
        </div>
    @endfor
@elseif($type === 'testimonials')
    @for($i = 0; $i < $count; $i++)
        <div class="col-md-4">
            <div class="skeleton skeleton-card h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="skeleton-circle skeleton"></div>
                    <div>
                        <div class="skeleton-title skeleton" style="width: 100px;"></div>
                        <div class="skeleton-text skeleton" style="width: 80px;"></div>
                    </div>
                </div>
                <div class="skeleton-text skeleton"></div>
                <div class="skeleton-text skeleton"></div>
                <div class="skeleton-text skeleton" style="width: 60%;"></div>
            </div>
        </div>
    @endfor
@elseif($type === 'profile')
    <div class="text-center mb-4">
        <div class="skeleton skeleton-circle mx-auto" style="width: 150px; height: 150px;"></div>
        <div class="skeleton-title skeleton mx-auto mt-3" style="width: 200px;"></div>
        <div class="skeleton-text skeleton mx-auto" style="width: 150px;"></div>
    </div>
@endif
