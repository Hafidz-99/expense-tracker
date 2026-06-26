<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <x-ui.stat-card title="Total Spending" :value="'RM ' . number_format($totalSpending, 2)" />

    <x-ui.stat-card title="Transactions" :value="$totalTransactions" />

    <x-ui.stat-card title="Average Daily" :value="'RM ' . number_format($averageDailySpending, 2)" />

    <x-ui.stat-card title="Top Category" :value="$topCategory['category']->name ?? 'No data'" />
</div>
