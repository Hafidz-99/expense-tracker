@props(['id', 'title', 'description' => null, 'maxWidth' => 'max-w-md'])

<div id="{{ $id }}" class="fixed inset-0 z-[9999] hidden">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black/50"></div>

    {{-- Modal content --}}
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div
            {{ $attributes->merge([
                'class' => "w-full {$maxWidth} overflow-hidden bg-white border shadow-xl rounded-2xl border-slate-200",
            ]) }}>
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-900">
                    {{ $title }}
                </h2>

                @if ($description)
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $description }}
                    </p>
                @endif
            </div>

            <div class="p-6">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="px-6 py-4 border-t bg-slate-50 border-slate-200">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
