<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900">
                Monthly Budget
            </h3>
            <p class="mt-1 text-sm text-slate-500">
                Budget usage for {{ now()->format('F Y') }}.
            </p>
        </div>

        <a href="{{ route('budgets.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
            Manage
        </a>
    </div>

    @if ($currentBudget)
        @php
            $progressColor = 'bg-green-500';

            if ($budgetUsedPercentage >= 100) {
                $progressColor = 'bg-red-500';
            } elseif ($budgetUsedPercentage >= 80) {
                $progressColor = 'bg-yellow-500';
            }
        @endphp

        <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-3">
            <div>
                <p class="text-sm text-slate-500">Budget</p>
                <p class="mt-1 text-xl font-bold text-slate-900">
                    RM {{ number_format($budgetAmount, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Spent</p>
                <p class="mt-1 text-xl font-bold text-slate-900">
                    RM {{ number_format($monthlyTotal, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Remaining</p>
                <p
                    class="mt-1 text-xl font-bold {{ $monthlyTotal > $budgetAmount ? 'text-red-600' : 'text-slate-900' }}">
                    RM {{ number_format($remainingBudget, 2) }}
                </p>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex items-center justify-between text-sm">
                <span class="font-medium text-slate-700">
                    {{ number_format($budgetUsedPercentage, 0) }}% used
                </span>

                @if ($budgetUsedPercentage >= 100)
                    <span class="font-semibold text-red-600">Over budget</span>
                @elseif ($budgetUsedPercentage >= 80)
                    <span class="font-semibold text-yellow-600">Almost reached</span>
                @else
                    <span class="font-semibold text-green-600">On track</span>
                @endif
            </div>

            <div class="w-full h-3 mt-3 overflow-hidden rounded-full bg-slate-100">
                <div class="h-3 rounded-full {{ $progressColor }}" style="width: {{ $budgetUsedPercentage }}%">
                </div>
            </div>
        </div>
    @else
        <div class="p-6 mt-6 text-center border border-dashed border-slate-300 rounded-2xl bg-slate-50">
            <p class="font-semibold text-slate-800">
                No budget set for this month.
            </p>
            <p class="mt-1 text-sm text-slate-500">
                Set a monthly budget to track how much you can still spend.
            </p>

            <a href="{{ route('budgets.index') }}"
                class="inline-flex items-center px-4 py-2 mt-4 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                Set Budget
            </a>
        </div>
    @endif
</div>
