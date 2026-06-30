<x-ui.card class="lg:col-span-2" title="Category Report"
    description="Category spending breakdown for the selected period.">
    <div class="space-y-5">
        @forelse ($categoryReports as $report)
            <div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center min-w-0 gap-3">
                        <span class="w-3 h-3 rounded-full shrink-0"
                            style="background-color: {{ $report['category']?->color ?? '#2563EB' }}"></span>

                        <div class="min-w-0">
                            <p class="font-semibold break-words text-slate-900 dark:text-slate-100">
                                {{ $report['category']?->name ?? 'Uncategorized' }}
                            </p>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                {{ $report['transactions'] }} transaction(s)
                                · Avg RM {{ number_format($report['average'], 2) }}
                            </p>
                        </div>
                    </div>

                    <div class="text-left sm:text-right shrink-0">
                        <p class="font-bold text-slate-900 dark:text-slate-100">
                            RM {{ number_format($report['total'], 2) }}
                        </p>

                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            {{ number_format($report['percentage'], 1) }}%
                        </p>
                    </div>
                </div>

                <div class="w-full h-2 mt-3 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                    <div class="h-2 transition-all duration-700 rounded-full"
                        style="
                            width: {{ min($report['percentage'], 100) }}%;
                            background-color: {{ $report['category']?->color ?? '#2563EB' }};
                        ">
                    </div>
                </div>
            </div>
        @empty
            <x-ui.empty-state title="No report data" description="Add expenses for this period to generate a report." />
        @endforelse
    </div>
</x-ui.card>
