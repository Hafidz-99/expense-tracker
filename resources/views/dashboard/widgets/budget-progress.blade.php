<x-ui.card title="Monthly Budget" :description="'Budget usage for ' . now()->format('F Y')" class="h-full">
    <x-slot:actions>
        <x-ui.button href="{{ route('budgets.index') }}" variant="secondary" class="w-full sm:w-auto">
            Manage
        </x-ui.button>
    </x-slot:actions>

    @if ($currentBudget)
        @php
            $progressColor = 'bg-green-500';

            if ($budgetUsedPercentage >= 100) {
                $progressColor = 'bg-red-500';
            } elseif ($budgetUsedPercentage >= 80) {
                $progressColor = 'bg-yellow-500';
            }
        @endphp

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-slate-900/40 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400">Budget</p>
                <p class="mt-1 text-xl font-bold text-slate-900 dark:text-slate-100">
                    RM {{ number_format($budgetAmount, 2) }}
                </p>
            </div>

            <div class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-slate-900/40 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400">Spent</p>
                <p class="mt-1 text-xl font-bold text-slate-900 dark:text-slate-100">
                    RM {{ number_format($monthlyTotal, 2) }}
                </p>
            </div>

            <div class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-slate-900/40 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400">Remaining</p>
                <p
                    class="mt-1 text-xl font-bold {{ $remainingBudget < 0 ? 'text-red-600' : 'text-slate-900 dark:text-slate-100' }}">
                    @if ($remainingBudget < 0)
                        -RM {{ number_format(abs($remainingBudget), 2) }}
                    @else
                        RM {{ number_format($remainingBudget, 2) }}
                    @endif
                </p>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex items-center justify-between text-sm">
                <span class="font-medium text-slate-700 dark:text-slate-300">
                    {{ number_format($budgetUsedPercentage, 0) }}% used
                </span>

                @if ($budgetUsedPercentage >= 100)
                    <x-ui.badge variant="danger">Over budget</x-ui.badge>
                @elseif ($budgetUsedPercentage >= 80)
                    <x-ui.badge variant="warning">Almost reached</x-ui.badge>
                @else
                    <x-ui.badge variant="success">On track</x-ui.badge>
                @endif
            </div>

            <div class="w-full h-3 mt-3 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                <div class="h-3 rounded-full transition-all duration-700 {{ $progressColor }}"
                    style="width: {{ min($budgetUsedPercentage, 100) }}%">
                </div>
            </div>
        </div>

        <div
            class="p-4 mt-4 border rounded-xl
                {{ $budgetStatus === 'danger' ? 'bg-red-50 border-red-100 dark:bg-red-500/10 dark:border-red-500/30' : '' }}
                {{ $budgetStatus === 'warning' ? 'bg-yellow-50 border-yellow-100 dark:bg-yellow-500/10 dark:border-yellow-500/30' : '' }}
                {{ $budgetStatus === 'success' ? 'bg-green-50 border-green-100 dark:bg-green-500/10 dark:border-green-500/30' : '' }}
                {{ $budgetStatus === 'none' ? 'bg-slate-50 border-slate-200 dark:bg-slate-900/40 dark:border-slate-700' : '' }}
            ">
            <p
                class="text-sm font-semibold
                    {{ $budgetStatus === 'danger' ? 'text-red-700 dark:text-red-300' : '' }}
                    {{ $budgetStatus === 'warning' ? 'text-yellow-700 dark:text-yellow-300' : '' }}
                    {{ $budgetStatus === 'success' ? 'text-green-700 dark:text-green-300' : '' }}
                    {{ $budgetStatus === 'none' ? 'text-slate-700 dark:text-slate-300' : '' }}
                ">
                {{ $budgetMessage }}
            </p>
        </div>
    @else
        <x-ui.empty-state title="No budget set" description="Create a monthly budget to monitor your spending." />

        <div class="flex justify-center mt-5">
            <x-ui.button href="{{ route('budgets.index') }}" class="w-full sm:w-auto">
                Set Budget
            </x-ui.button>
        </div>
    @endif
</x-ui.card>
