@props(['id', 'title', 'description' => null, 'maxWidth' => 'max-w-md'])

<div id="{{ $id }}" class="fixed inset-0 z-[9999] hidden">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

    {{-- Modal content --}}
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div
            {{ $attributes->merge([
                'class' => "w-full {$maxWidth} overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl dark:border-slate-700 dark:bg-slate-800",
            ]) }}>
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                    {{ $title }}
                </h2>

                @if ($description)
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ $description }}
                    </p>
                @endif
            </div>

            <div class="p-6">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/40">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
