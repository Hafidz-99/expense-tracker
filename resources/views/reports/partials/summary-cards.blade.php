<x-ui.card title="Report Overview" :description="'Spending summary for ' . $reportPeriod . '.'">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

        {{-- Total Spending --}}
        <div class="p-5 border rounded-2xl border-slate-200 bg-slate-50">
            <p class="text-xs font-semibold tracking-wide uppercase text-slate-500">
                Total Spending
            </p>

            <h2 class="mt-2 text-3xl font-bold text-slate-900">
                RM {{ number_format($totalSpending, 2) }}
            </h2>
        </div>

        {{-- Transactions --}}
        <div class="flex items-center justify-between p-5 border rounded-2xl border-slate-200">
            <div>
                <p class="text-xs font-semibold tracking-wide uppercase text-slate-400">
                    Transactions
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Expense records
                </p>
            </div>

            <p class="text-3xl font-bold text-slate-900">
                {{ number_format($totalTransactions) }}
            </p>
        </div>

        {{-- Average Transaction --}}
        <div class="flex items-center justify-between p-5 border rounded-2xl border-slate-200">
            <div>
                <p class="text-xs font-semibold tracking-wide uppercase text-slate-400">
                    Average Transaction
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Per expense
                </p>
            </div>

            <p class="text-2xl font-bold text-slate-900">
                RM {{ number_format($averageTransaction, 2) }}
            </p>
        </div>

        {{-- Top Category --}}
        <div class="flex items-center justify-between p-5 border rounded-2xl border-slate-200">
            <div>
                <p class="text-xs font-semibold tracking-wide uppercase text-slate-400">
                    Top Category
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Highest spending
                </p>
            </div>

            <div class="text-right">
                <p class="text-xl font-bold text-slate-900">
                    {{ $topCategory['category']->name ?? 'No data' }}
                </p>

                @if ($topCategory)
                    <p class="text-sm text-slate-500">
                        RM {{ number_format($topCategory['total'], 2) }}
                    </p>
                @endif
            </div>
        </div>

    </div>
</x-ui.card>
