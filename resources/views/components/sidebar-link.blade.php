@props(['route','ikon','pola'=>null])

@php
    $aktif = request()->routeIs($pola ?? $route);
@endphp

<li>
    <a href="{{ route($route) }}"
    class="nav-link d-flex align-items-center gap-2 {{ $aktif ? 'active' : '' }}"
    @if ($aktif) aria-current="page" @endif>
        <i class="bi {{ $ikon }}"></i>
        <span>{{ $slot }}</span>
    </a>
</li>