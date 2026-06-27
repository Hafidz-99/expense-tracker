<x-ui.card title="Report Insight" description="Quick highlights from the selected report.">
    <div class="space-y-5">
        <div class="flex items-start justify-between gap-4">
            <span class="text-sm text-slate-500">
                Selected Period
            </span>

            <span class="text-sm font-semibold text-right text-slate-900">
                @if ($startDate && $endDate)
                    {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
                    -
                    {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
                @else
                    {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y') }}
                @endif
            </span>
        </div>

        <div class="flex items-start justify-between gap-4">
            <span class="text-sm text-slate-500">
                Highest Category
            </span>

            <span class="text-sm font-semibold text-right text-slate-900">
                {{ $topCategory['category']->name ?? 'No data' }}
            </span>
        </div>

        <div class="flex items-start justify-between gap-4">
            <span class="text-sm text-slate-500">
                Used Categories
            </span>

            <span class="text-sm font-semibold text-slate-900">
                {{ $categoryReports->count() }}
            </span>
        </div>

        <div class="flex items-start justify-between gap-4">
            <span class="text-sm text-slate-500">
                Average Transaction
            </span>

            <span class="text-sm font-semibold text-slate-900">
                RM {{ number_format($averageTransaction, 2) }}
            </span>
        </div>

        <div class="flex items-start justify-between gap-4">
            <span class="text-sm text-slate-500">
                Largest Expense
            </span>

            <span class="text-sm font-semibold text-slate-900">
                RM {{ number_format($largestExpense?->amount ?? 0, 2) }}
            </span>
        </div>
    </div>
</x-ui.card>
