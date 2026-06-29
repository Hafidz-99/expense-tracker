@props([
    'title' => 'No data found',
    'description' => 'There is nothing to show here yet.',
])

<div
    {{ $attributes->merge([
        'class' =>
            'flex flex-col items-center justify-center px-6 py-12 text-center border border-dashed border-slate-300 rounded-2xl bg-slate-50 dark:border-slate-700 dark:bg-slate-800/50',
    ]) }}>
    <div
        class="flex items-center justify-center w-12 h-12 bg-white border rounded-full shadow-sm border-slate-200 dark:bg-slate-900 dark:border-slate-700">
        <svg class="w-6 h-6 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M20 13V7a2 2 0 0 0-2-2h-3.5L12 2.5 9.5 5H6a2 2 0 0 0-2 2v6m16 0v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-4m16 0H4" />
        </svg>
    </div>

    <h3 class="mt-4 text-sm font-bold text-slate-900 dark:text-slate-100">
        {{ $title }}
    </h3>

    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        {{ $description }}
    </p>
</div>
