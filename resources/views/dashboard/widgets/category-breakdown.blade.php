<x-ui.card title="Top Categories" description="Your three highest spending categories this month."
    class="flex h-full flex-col" bodyClass="flex flex-1 flex-col">
    <x-slot:actions>
        <x-ui.button href="{{ route('reports.index') }}" variant="secondary">
            View Report
        </x-ui.button>
    </x-slot:actions>

    @if ($categoryBreakdown->isNotEmpty())
        <div class="flex flex-1 flex-col justify-evenly gap-6 p-4">
            @foreach ($categoryBreakdown as $category)
                @php
                    $percentage = $monthlyTotal > 0 ? round(($category->total / $monthlyTotal) * 100) : 0;
                @endphp

                <div>
                    <div class="flex items-start justify-between gap-4">
                        <p class="text-base font-bold break-words text-slate-700 dark:text-slate-300">
                            {{ $category->category?->name ?? 'Unknown Category' }}
                        </p>

                        <p class="text-base font-extrabold text-slate-900 dark:text-slate-100 shrink-0">
                            RM {{ number_format($category->total, 2) }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3 mt-3">
                        <div class="flex-1 h-3 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                            <div class="h-full transition-all duration-700 rounded-full"
                                style="
                                    width: {{ min($percentage, 100) }}%;
                                    background-color: {{ $category->category?->color ?? '#2563EB' }};
                                ">
                            </div>
                        </div>

                        <span class="w-12 text-sm font-bold text-right text-slate-500 dark:text-slate-400">
                            {{ $percentage }}%
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-1 items-center">
            <x-ui.empty-state title="No category data" description="Add expenses to see your spending breakdown." />
        </div>
    @endif
</x-ui.card>
