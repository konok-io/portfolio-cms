{{-- Breadcrumb Component --}}
{{-- Usage: <x-front-breadcrumb :items="$breadcrumbs" /> --}}

@props([
    'items' => [],
    'separator' => 'fa-solid fa-chevron-right',
    'showHome' => true,
    'class' => ''
])

@php
    // Build breadcrumb items
    $breadcrumbs = [];
    
    // Add home link if enabled
    if ($showHome) {
        $breadcrumbs[] = [
            'title' => 'Home',
            'url' => route('home'),
            'active' => false,
        ];
    }
    
    // Add custom items
    if (!empty($items)) {
        foreach ($items as $item) {
            $breadcrumbs[] = [
                'title' => $item['title'] ?? '',
                'url' => $item['url'] ?? '#',
                'active' => $item['active'] ?? false,
            ];
        }
    }
@endphp

@if(count($breadcrumbs) > 1)
    <nav aria-label="breadcrumb" class="breadcrumb-nav {{ $class }}">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $index => $crumb)
                @if($crumb['active'] || $loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="breadcrumb-current">{{ $crumb['title'] }}</span>
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $crumb['url'] }}">{{ $crumb['title'] }}</a>
                        <i class="{{ $separator }} breadcrumb-separator"></i>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif

<style>
.breadcrumb-nav {
    margin-bottom: 1.5rem;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.25rem;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--color-muted, #64748b);
}

.breadcrumb-item a {
    color: var(--color-muted, #64748b);
    text-decoration: none;
    transition: color 0.2s ease;
}

.breadcrumb-item a:hover {
    color: var(--color-primary, #2563eb);
}

.breadcrumb-separator {
    font-size: 0.625rem;
    color: var(--color-border, #e2e8f0);
}

.breadcrumb-item.active {
    color: var(--color-secondary, #0F172A);
    font-weight: 500;
}

.breadcrumb-current {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

[data-theme="dark"] .breadcrumb-item {
    color: #A8A4C8;
}

[data-theme="dark"] .breadcrumb-item a {
    color: #A8A4C8;
}

[data-theme="dark"] .breadcrumb-item a:hover {
    color: #67E8F9;
}

[data-theme="dark"] .breadcrumb-separator {
    color: #3D3A70;
}

[data-theme="dark"] .breadcrumb-item.active,
[data-theme="dark"] .breadcrumb-current {
    color: #E8E6F2;
}

@media (max-width: 576px) {
    .breadcrumb {
        font-size: 0.75rem;
    }
    
    .breadcrumb-current {
        max-width: 120px;
    }
}
</style>
