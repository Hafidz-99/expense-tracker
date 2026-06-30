<x-ui.card title="Budget Overview" :description="'Summary of your budget usage for ' . now()->format('F Y') . '.'">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <x-ui.stat-card title="Current Budget" :value="'RM ' . number_format($currentBudgetAmount, 2)" subtitle="Budget set for this month" />

        <x-ui.stat-card title="Current Spending" :value="'RM ' . number_format($currentSpending, 2)" subtitle="Total spent this month" />

        <x-ui.stat-card title="Remaining" :value="$currentRemaining < 0
            ? '-RM ' . number_format(abs($currentRemaining), 2)
            : 'RM ' . number_format($currentRemaining, 2)"
            :subtitle="$currentRemaining < 0 ? 'You are over budget' : 'Available balance left'"
            :class="$currentRemaining < 0 ?
                'ring-1 ring-red-100 dark:ring-red-500/30 sm:col-span-2 lg:col-span-1' :
                'sm:col-span-2 lg:col-span-1'" />
    </div>
</x-ui.card>
