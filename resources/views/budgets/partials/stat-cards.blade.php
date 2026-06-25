<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-medium text-slate-500">Current Budget</p>
        <p class="mt-2 text-2xl font-bold text-slate-900">
            RM {{ number_format($currentBudgetAmount, 2) }}
        </p>
    </div>

    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-medium text-slate-500">Current Spending</p>
        <p class="mt-2 text-2xl font-bold text-slate-900">
            RM {{ number_format($currentSpending, 2) }}
        </p>
    </div>

    <div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
        <p class="text-sm font-medium text-slate-500">Remaining</p>
        <p class="mt-2 text-2xl font-bold {{ $currentRemaining < 0 ? 'text-red-600' : 'text-slate-900' }}">
            @if ($currentRemaining < 0)
                -RM {{ number_format(abs($currentRemaining), 2) }}
            @else
                RM {{ number_format($currentRemaining, 2) }}
            @endif
        </p>
    </div>
</div>
