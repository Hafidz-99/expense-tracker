<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-semibold text-slate-500">This Month</p>
        <p class="mt-3 text-3xl font-extrabold text-slate-900">
            RM {{ number_format($monthlyTotal, 2) }}
        </p>
        <p class="mt-2 text-sm text-slate-500">
            Total spending in {{ now()->format('F Y') }}
        </p>
    </div>

    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-semibold text-slate-500">Today</p>
        <p class="mt-3 text-3xl font-extrabold text-slate-900">
            RM {{ number_format($todayTotal, 2) }}
        </p>
        <p class="mt-2 text-sm text-slate-500">
            Spending for {{ now()->format('d/m/Y') }}
        </p>
    </div>

    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-semibold text-slate-500">Transactions</p>
        <p class="mt-3 text-3xl font-extrabold text-slate-900">
            {{ $totalTransactions }}
        </p>
        <p class="mt-2 text-sm text-slate-500">
            Total expenses recorded
        </p>
    </div>

    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-semibold text-slate-500">Top Category</p>

        @if ($topCategory)
            <p class="mt-3 text-3xl font-extrabold text-slate-900">
                {{ $topCategory->category->name ?? 'Uncategorized' }}
            </p>
            <p class="mt-2 text-sm text-slate-500">
                RM {{ number_format($topCategory->total, 2) }} this month
            </p>
        @else
            <p class="mt-3 text-3xl font-extrabold text-slate-900">
                -
            </p>
            <p class="mt-2 text-sm text-slate-500">
                No expenses this month
            </p>
        @endif
    </div>
</div>
