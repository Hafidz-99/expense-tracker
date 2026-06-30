@props(['title', 'value', 'subtitle' => null])

<div
    {{ $attributes->merge([
        'class' =>
            'p-6 transition-all duration-200 bg-white border shadow-sm border-slate-200 rounded-2xl hover:shadow-md hover:-translate-y-1 dark:bg-slate-800 dark:border-slate-700',
    ]) }}>
    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
        {{ $title }}
    </p>

    <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
        {{ $value }}
    </p>

    @if ($subtitle)
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            {{ $subtitle }}
        </p>
    @endif
</div>
