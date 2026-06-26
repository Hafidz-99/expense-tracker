@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
    'loading' => false,
    'loadingText' => 'Loading...',
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
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $classes]) }}
        @if ($loading) x-data="{ loading: false }"
    @click="loading = true"
    :disabled="loading"
    :class="{ 'opacity-70 cursor-not-allowed': loading }" @endif>
        @if ($loading)
            <span x-show="loading" class="flex items-center gap-2">
                <svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />

                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>

                {{ $loadingText }}
            </span>

            <span x-show="!loading">
                {{ $slot }}
            </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
