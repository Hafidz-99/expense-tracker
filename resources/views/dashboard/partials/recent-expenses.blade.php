<x-ui.card title="Recent Expenses" description="Latest expenses you recorded.">
    <x-slot:actions>
        <x-ui.button href="{{ route('expenses.index') }}" variant="secondary">
            View All
        </x-ui.button>
    </x-slot:actions>

    @forelse ($recentExpenses as $expense)
        <div
            class="flex items-center justify-between gap-4 py-4 border-b border-slate-100 last:border-b-0 last:pb-0 first:pt-0">
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

                <p class="mt-2 text-sm font-medium truncate text-slate-700">
                    {{ $expense->description ?: 'No description' }}
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                </p>
            </div>

            <p class="text-sm font-bold text-slate-900 shrink-0">
                RM {{ number_format($expense->amount, 2) }}
            </p>
        </div>
    @empty
        <x-ui.empty-state title="No recent expenses" description="Your latest expenses will appear here." />
    @endforelse
</x-ui.card>
