<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <x-ui.stat-card title="Current Budget" :value="'RM ' . number_format($currentBudgetAmount, 2)" subtitle="Budget set for this month" />

    <x-ui.stat-card title="Current Spending" :value="'RM ' . number_format($currentSpending, 2)" subtitle="Total spent this month" />

    <x-ui.stat-card title="Remaining" :value="$currentRemaining < 0
        ? '-RM ' . number_format(abs($currentRemaining), 2)
        : 'RM ' . number_format($currentRemaining, 2)"
        :subtitle="$currentRemaining < 0 ? 'You are over budget' : 'Available balance left'"
        :class="$currentRemaining < 0 ? 'ring-1 ring-red-100' : ''" />
</div>
