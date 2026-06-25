<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">
    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Average Transaction</p>
        <h2 class="mt-2 text-2xl font-bold text-slate-900">
            RM {{ number_format($averageTransaction, 2) }}
        </h2>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Largest Expense</p>
        <h2 class="mt-2 text-2xl font-bold text-slate-900">
            RM {{ number_format($largestExpense->amount ?? 0, 2) }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ $largestExpense->category->name ?? 'No data' }}
        </p>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Most Used Category</p>
        <h2 class="mt-2 text-xl font-bold text-slate-900">
            {{ $mostUsedCategory['category']->name ?? 'No data' }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ $mostUsedCategory['transactions'] ?? 0 }} transaction(s)
        </p>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Vs Previous Month</p>

        <h2
            class="mt-2 text-2xl font-bold
            @if ($monthlyDifference > 0) text-red-600
            @elseif ($monthlyDifference < 0)
                text-green-600
            @else
                text-slate-900 @endif
        ">
            @if ($monthlyDifference > 0)
                +RM {{ number_format($monthlyDifference, 2) }}
            @elseif ($monthlyDifference < 0)
                -RM {{ number_format(abs($monthlyDifference), 2) }}
            @else
                RM 0.00
            @endif
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ number_format(abs($monthlyDifferencePercentage), 1) }}%
            @if ($monthlyDifference > 0)
                higher
            @elseif ($monthlyDifference < 0)
                lower
            @else
                no change
            @endif
        </p>
    </div>
    <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm text-slate-500">Highest Spending Month</p>
        <h2 class="mt-2 text-xl font-bold text-slate-900">
            {{ $highestSpendingMonth['month'] ?? 'No data' }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            RM {{ number_format($highestSpendingMonth['total'] ?? 0, 2) }}
        </p>
    </div>
</div>
