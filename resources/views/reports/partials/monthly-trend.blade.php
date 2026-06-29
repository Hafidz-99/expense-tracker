<x-ui.card title="Monthly Trend" description="Monthly spending compared across the selected year.">
    @php
        $highestMonthlyTotal = collect($monthlyTrend)->max('total') ?: 0;
    @endphp

    <div class="space-y-4">
        @forelse ($monthlyTrend as $trend)
            @php
                $percentage = $highestMonthlyTotal > 0 ? ($trend['total'] / $highestMonthlyTotal) * 100 : 0;
            @endphp

            <div class="space-y-2">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-sm font-medium text-slate-700">
                        {{ $trend['month'] }}
                    </p>

                    <p class="text-sm font-semibold text-slate-900">
                        RM {{ number_format($trend['total'], 2) }}
                    </p>
                </div>

                <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full bg-blue-600 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
        @empty
            <x-ui.empty-state title="No monthly trend" description="No spending data for the selected year." />
        @endforelse
    </div>
</x-ui.card>
