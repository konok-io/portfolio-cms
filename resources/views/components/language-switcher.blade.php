@props(['dropdown' => false])

@php
$languages = [
    'en' => ['name' => 'English', 'flag' => '🇺🇸'],
    'bn' => ['name' => 'বাংলা', 'flag' => '🇧🇩'],
];
$currentLocale = app()->getLocale();
@endphp

@if($dropdown)
    <div class="dropdown">
        <button class="btn btn-link language-switcher-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="flag-icon">{{ $languages[$currentLocale]['flag'] ?? '🌐' }}</span>
            <span class="d-none d-md-inline">{{ $languages[$currentLocale]['name'] ?? 'English' }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            @foreach($languages as $code => $lang)
                @if($code !== $currentLocale)
                    <li>
                        <a class="dropdown-item" href="{{ route('language.switch', $code) }}">
                            <span class="flag-icon">{{ $lang['flag'] }}</span>
                            {{ $lang['name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@else
    <div class="language-switcher">
        @foreach($languages as $code => $lang)
            <a href="{{ route('language.switch', $code) }}" 
               class="lang-btn {{ $code === $currentLocale ? 'active' : '' }}"
               title="{{ $lang['name'] }}">
                <span class="flag">{{ $lang['flag'] }}</span>
                <span class="code">{{ strtoupper($code) }}</span>
            </a>
        @endforeach
    </div>
@endif

<style>
.language-switcher {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.language-switcher .lang-btn {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
    transition: all 0.2s ease;
}

.language-switcher .lang-btn:hover {
    background: rgba(0, 0, 0, 0.05);
}

.language-switcher .lang-btn.active {
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
}

.language-switcher .flag {
    font-size: 1.25rem;
}

.language-switcher .code {
    font-size: 0.75rem;
    font-weight: 600;
}

.language-switcher-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: inherit;
}
</style>
