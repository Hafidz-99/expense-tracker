<x-ui.card title="Report Overview" :description="'Spending summary for ' . $reportPeriod . '.'">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

        {{-- Total Spending --}}
        <div class="p-5 border rounded-2xl border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/40">
            <p class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-slate-400">
                Total Spending
            </p>

            <h2 class="mt-2 text-3xl font-bold text-slate-900">
                RM {{ number_format($totalSpending, 2) }}
            </h2>
        </div>

        {{-- Transactions --}}
        <div
            class="flex items-center justify-between p-5 border rounded-2xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/30">
            <div>
                <p class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-slate-500">
                    Transactions
                </p>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Expense records
                </p>
            </div>

            <p class="text-3xl font-bold text-slate-900 dark:text-slate-100">
                {{ number_format($totalTransactions) }}
            </p>
        </div>

        {{-- Average Transaction --}}
        <div
            class="flex items-center justify-between p-5 border rounded-2xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/30">
            <div>
                <p class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-slate-500">
                    Average Transaction
                </p>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Per expense
                </p>
            </div>

            <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                RM {{ number_format($averageTransaction, 2) }}
            </p>
        </div>

        {{-- Top Category --}}
        <div
            class="flex items-center justify-between p-5 border rounded-2xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/30">
            <div>
                <p class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-slate-500">
                    Top Category
                </p>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Highest spending
                </p>
            </div>

            <div class="text-right">
                <p class="text-xl font-bold text-slate-900 dark:text-slate-100">
                    {{ $topCategory['category']->name ?? 'No data' }}
                </p>

                @if ($topCategory)
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        RM {{ number_format($topCategory['total'], 2) }}
                    </p>
                @endif
            </div>
        </div>

    </div>
</x-ui.card>
