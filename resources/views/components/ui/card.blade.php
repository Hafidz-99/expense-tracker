@props([
    'title' => null,
    'description' => null,
    'bodyClass' => 'px-6 py-4',
])

<div
    {{ $attributes->merge([
        'class' =>
            'flex flex-col w-full min-w-0 bg-white border border-slate-200 shadow-sm rounded-2xl dark:bg-slate-900 dark:border-slate-800',
    ]) }}>

    @if ($title || $description || isset($actions))
        <div class="px-3 py-3 border-b sm:px-6 border-slate-200 dark:border-slate-800">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="min-w-0">
                    @if ($title)
                        <h2 class="text-base font-bold break-words text-slate-900 dark:text-white">
                            {{ $title }}
                        </h2>
                    @endif

                    @if ($description)
                        <p class="mt-1 text-sm break-words text-slate-500 dark:text-slate-400">
                            {{ $description }}
                        </p>
                    @endif
                </div>

                @isset($actions)
                    <div class="flex w-full gap-2 sm:w-auto sm:items-center sm:shrink-0">
                        {{ $actions }}
                    </div>
                @endisset
            </div>
        </div>
    @endif

    <div class="flex-1 min-w-0 {{ $bodyClass }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-5 py-4 border-t sm:px-6 border-slate-200 dark:border-slate-800">
            {{ $footer }}
        </div>
    @endisset

</div>
