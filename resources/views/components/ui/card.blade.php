@props([
    'title' => null,
    'description' => null,
    'bodyClass' => 'p-6',
])

<div
    {{ $attributes->merge([
        'class' => 'flex flex-col w-full bg-white border border-slate-200 shadow-sm rounded-2xl',
    ]) }}>

    @if ($title || $description || isset($actions))
        <div class="px-6 py-5 border-b border-slate-200">
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    @if ($title)
                        <h2 class="text-base font-bold text-slate-900">
                            {{ $title }}
                        </h2>
                    @endif

                    @if ($description)
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $description }}
                        </p>
                    @endif
                </div>

                @isset($actions)
                    <div class="flex items-center gap-2 shrink-0">
                        {{ $actions }}
                    </div>
                @endisset
            </div>
        </div>
    @endif

    <div class="flex-1 {{ $bodyClass }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $footer }}
        </div>
    @endisset

</div>
