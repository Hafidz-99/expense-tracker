<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Total Spending</p>
        <h2 class="mt-2 text-2xl font-bold text-slate-900">
            RM {{ number_format($totalSpending, 2) }}
        </h2>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Transactions</p>
        <h2 class="mt-2 text-2xl font-bold text-slate-900">
            {{ $totalTransactions }}
        </h2>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Average Daily Spending</p>
        <h2 class="mt-2 text-2xl font-bold text-slate-900">
            RM {{ number_format($averageDailySpending, 2) }}
        </h2>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Top Category</p>
        <h2 class="mt-2 text-xl font-bold text-slate-900">
            {{ $topCategory['category']->name ?? 'No data' }}
        </h2>
    </div>
</div>
