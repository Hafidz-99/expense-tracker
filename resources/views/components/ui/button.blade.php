@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
])

@php
    $classes = match ($variant) {
        'secondary' => 'bg-white text-slate-700 border border-slate-300 hover:bg-slate-50',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'ghost' => 'bg-transparent text-slate-600 hover:bg-slate-100',
        default => 'bg-blue-600 text-white hover:bg-blue-700',
    };

    $baseClasses =
        'inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold transition rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $classes]) }}>
        {{ $slot }}
    </button>
@endif
