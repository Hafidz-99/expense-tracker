<div class="p-6 bg-white border shadow-sm lg:col-span-2 border-slate-200 rounded-2xl">
    <h2 class="text-lg font-bold text-slate-900">Category Report</h2>

    <div class="mt-6 space-y-5">
        @forelse ($categoryReports as $report)
            <div>
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full"
                            style="background-color: {{ $report['category']->color ?? '#2563EB' }}"></span>

                        <div>
                            <p class="font-semibold text-slate-900">
                                {{ $report['category']->name ?? 'Uncategorized' }}
                            </p>
                            <p class="text-sm text-slate-500">
                                {{ $report['transactions'] }} transaction(s)
                                · Avg RM
                                {{ number_format($report['transactions'] > 0 ? $report['total'] / $report['transactions'] : 0, 2) }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-slate-900">
                            RM {{ number_format($report['total'], 2) }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ number_format($report['percentage'], 1) }}%
                        </p>
                    </div>
                </div>

                <div class="w-full h-2 mt-3 rounded-full bg-slate-100">
                    <div class="h-2 bg-blue-600 rounded-full" style="width: {{ min($report['percentage'], 100) }}%">
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center">
                <p class="font-medium text-slate-700">No report data yet</p>
                <p class="mt-1 text-sm text-slate-500">
                    Add expenses for this period to generate a report.
                </p>
            </div>
        @endforelse
    </div>
</div>
