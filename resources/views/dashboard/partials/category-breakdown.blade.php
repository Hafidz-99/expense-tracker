<x-ui.card title="Top Categories" description="Your five highest spending categories this month.">
    <x-slot:actions>
        <x-ui.button href="{{ route('reports.index') }}" variant="secondary">
            View Report
        </x-ui.button>
    </x-slot:actions>
    @forelse ($categoryBreakdown as $category)
        @php
            $percentage = $monthlyTotal > 0 ? round(($category->total / $monthlyTotal) * 100) : 0;
        @endphp

        <div class="mb-5 last:mb-0">
            <div class="flex items-center justify-between gap-3">
                <p class="text-sm font-semibold truncate text-slate-700">
                    {{ $category->category?->name ?? 'Unknown Category' }}
                </p>

                <p class="text-sm font-bold text-slate-900 shrink-0">
                    RM {{ number_format($category->total, 2) }}
                </p>
            </div>

            <div class="flex items-center gap-3 mt-2">
                <div class="flex-1 h-2 overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full transition-all duration-700 rounded-full"
                        style="
                            width: {{ min($percentage, 100) }}%;
                            background-color: {{ $category->category?->color ?? '#2563EB' }};
                        ">
                    </div>
                </div>

                <span class="w-10 text-xs font-semibold text-right text-slate-500">
                    {{ $percentage }}%
                </span>
            </div>
        </div>
    @empty
        <x-ui.empty-state title="No category data" description="Add expenses to see your spending breakdown." />
    @endforelse
</x-ui.card>
