@props([
    'href' => '/',
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'space-y-2']) }}>
    <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-slate-100">
        Expense<span class="italic text-blue-600 dark:text-blue-400">Tracker</span>
    </h1>

    <div class="flex items-center gap-3">
        <div class="w-8 h-px bg-blue-600 dark:bg-blue-400"></div>

        <p class="text-xs font-medium tracking-[0.2em] uppercase text-slate-500 dark:text-slate-400">
            Personal Finance
        </p>
    </div>
</a>
