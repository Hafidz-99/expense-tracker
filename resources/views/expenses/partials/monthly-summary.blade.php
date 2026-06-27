<x-ui.card class="lg:sticky lg:top-6" title="Monthly Summary" description="Spending by category.">
    <x-slot:actions>
        <x-ui.badge variant="blue">
            {{ \Carbon\Carbon::create(null, (int) $selectedMonth, 1)->format('M') }}
            {{ $selectedYear }}
        </x-ui.badge>
    </x-slot:actions>

    <div class="mt-6 space-y-5">
        @php
            $summaryTotal = $monthlySummary->sum('total');
        @endphp

        @forelse ($monthlySummary as $summary)
            @php
                $percentage = $summaryTotal > 0 ? round(($summary->total / $summaryTotal) * 100) : 0;
            @endphp

            <div>
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold truncate text-slate-700">
                        {{ $summary->category?->name ?? 'Unknown Category' }}
                    </p>

                    <p class="text-sm font-bold text-slate-900 shrink-0">
                        RM {{ number_format($summary->total, 2) }}
                    </p>
                </div>

                <div class="flex items-center gap-3 mt-2">
                    <div class="flex-1 h-2 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full transition-all duration-500 rounded-full"
                            style="
                                width: {{ min($percentage, 100) }}%;
                                background-color: {{ $summary->category->color ?? '#2563EB' }};
                            ">
                        </div>
                    </div>

                    <span class="w-10 text-xs font-semibold text-right text-slate-500">
                        {{ $percentage }}%
                    </span>
                </div>
            </div>
        @empty
            <div class="py-4">
                <x-ui.empty-state title="No summary yet" description="Add expenses to see category totals." />
            </div>
        @endforelse
    </div>
</x-ui.card>
