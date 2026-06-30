<x-ui.card title="Recent Expenses" description="Latest expenses you recorded." bodyClass="p-0 overflow-hidden">
    <x-slot:actions>
        <x-ui.button href="{{ route('expenses.index') }}" variant="secondary">
            View All
        </x-ui.button>
    </x-slot:actions>

    @forelse ($recentExpenses as $expense)
        <div
            class="flex flex-col gap-4 px-5 py-5 transition-colors duration-150 border-b border-slate-100 last:border-b-0 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800/40 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <x-ui.badge
                        style="
                            background-color: {{ $expense->category?->color ?? '#2563EB' }}20;
                            color: {{ $expense->category?->color ?? '#2563EB' }};
                        ">
                        {{ $expense->category?->name ?? 'Unknown' }}
                    </x-ui.badge>
                </div>

                <p class="mt-2 text-sm font-medium break-words text-slate-700 dark:text-slate-300">
                    {{ $expense->description ?: 'No description' }}
                </p>

                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                </p>
            </div>

            <p class="text-sm font-bold text-left text-slate-900 dark:text-slate-100 shrink-0 sm:text-right">
                RM {{ number_format($expense->amount, 2) }}
            </p>
        </div>
    @empty
        <div class="p-6">
            <x-ui.empty-state title="No recent expenses" description="Your latest expenses will appear here." />
        </div>
    @endforelse
</x-ui.card>
