<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Monthly Trend</h2>
            <p class="mt-1 text-sm text-slate-500">
                Spending summary for each month in the selected year.
            </p>
        </div>
    </div>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead>
                <tr class="text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                    <th class="py-3 pr-4">Month</th>
                    <th class="py-3 text-right">Total Spending</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse ($monthlyTrend as $trend)
                    <tr>
                        <td class="py-4 pr-4 text-sm font-medium text-slate-700">
                            {{ $trend['month'] }}
                        </td>

                        <td class="py-4 text-sm font-semibold text-right text-slate-900">
                            RM {{ number_format($trend['total'], 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="py-12 text-sm text-center text-slate-500">
                            No monthly trend data found for this year.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
