@props(['title', 'value', 'subtitle' => null])

<div
    class="p-6 transition-all duration-200 bg-white border shadow-sm border-slate-200 rounded-2xl hover:shadow-md hover:-translate-y-1">
    <p class="text-sm font-semibold text-slate-500">
        {{ $title }}
    </p>

    <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
        {{ $value }}
    </p>

    @if ($subtitle)
        <p class="mt-2 text-sm text-slate-500">
            {{ $subtitle }}
        </p>
    @endif
</div>
