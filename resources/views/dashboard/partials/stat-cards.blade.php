<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <x-ui.stat-card title="This Month" :value="'RM ' . number_format($monthlyTotal, 2)" :subtitle="'Total spending in ' . now()->format('F Y')" />

    <x-ui.stat-card title="Today" :value="'RM ' . number_format($todayTotal, 2)" :subtitle="'Spending for ' . now()->format('d/m/Y')" />

    <x-ui.stat-card title="Transactions" :value="$totalTransactions" subtitle="Total expenses recorded" />

    <x-ui.stat-card title="Top Category" :value="$topCategory?->category?->name ?? '-'" :subtitle="$topCategory ? 'RM ' . number_format($topCategory->total, 2) . ' this month' : 'No expenses this month'" />
</div>
