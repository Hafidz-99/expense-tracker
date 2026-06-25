<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <h2 class="text-lg font-bold text-slate-900">Report Insight</h2>

    <div class="mt-6 space-y-4">
        <div>
            <p class="text-sm text-slate-500">Selected Period</p>
            <p class="font-semibold text-slate-900">
                @if ($startDate && $endDate)
                    {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
                    -
                    {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
                @else
                    {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y') }}
                @endif
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Highest Spending Category</p>
            <p class="font-semibold text-slate-900">
                {{ $topCategory['category']->name ?? 'No data' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Used Categories</p>
            <p class="font-semibold text-slate-900">
                {{ $categoryReports->count() }}
            </p>
        </div>
    </div>
</div>
