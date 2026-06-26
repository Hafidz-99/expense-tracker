<x-ui.card title="Monthly Trend" description="Spending summary for each month." bodyClass="p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Month
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500">
                        Total Spending
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-100">
                @forelse ($monthlyTrend as $trend)
                    <tr class="transition-colors duration-150 hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-700">
                            {{ $trend['month'] }}
                        </td>

                        <td class="px-6 py-4 text-sm font-semibold text-right text-slate-900">
                            RM {{ number_format($trend['total'], 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-6">
                            <x-ui.empty-state title="No monthly trend"
                                description="No spending data for the selected year." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>
