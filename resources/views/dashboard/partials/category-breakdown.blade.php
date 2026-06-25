<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900">
                Monthly Spending
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Breakdown by category.
            </p>
        </div>

        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">
            {{ now()->format('M Y') }}
        </span>
    </div>

    <div class="mt-6 space-y-5">
        @forelse ($categoryBreakdown as $item)
            @php
                $percentage = $monthlyTotal > 0 ? round(($item->total / $monthlyTotal) * 100) : 0;
            @endphp

            <div>
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold truncate text-slate-700">
                        {{ $item->category->name ?? 'Uncategorized' }}
                    </p>

                    <p class="text-sm font-bold text-slate-900 shrink-0">
                        RM {{ number_format($item->total, 2) }}
                    </p>
                </div>

                <div class="flex items-center gap-3 mt-2">
                    <div class="flex-1 h-2 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full bg-blue-600 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>

                    <span class="w-10 text-xs font-semibold text-right text-slate-500">
                        {{ $percentage }}%
                    </span>
                </div>
            </div>
        @empty
            <div class="py-10 text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto text-blue-600 rounded-2xl bg-blue-50">
                    %
                </div>

                <h3 class="mt-4 text-sm font-bold text-slate-900">
                    No category data
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Add expenses to see your spending breakdown.
                </p>
            </div>
        @endforelse
    </div>
</div>
