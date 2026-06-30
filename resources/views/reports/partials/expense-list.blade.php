<x-ui.card title="Expense List" :description="Str::plural('record', $expenses->count(), true) . ' found.'" bodyClass="p-0 overflow-hidden">

    {{-- Mobile cards --}}
    <div class="divide-y divide-slate-100 dark:divide-slate-700 md:hidden">
        @forelse ($expenses as $expense)
            <div class="p-5 space-y-3">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ $expense->category?->name ?? 'Uncategorized' }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </p>
                    </div>

                    <p class="text-sm font-bold text-right text-slate-900 dark:text-slate-100 shrink-0">
                        RM {{ number_format($expense->amount, 2) }}
                    </p>
                </div>

                <p
                    class="text-sm break-words {{ $expense->description ? 'text-slate-500 dark:text-slate-400' : 'italic text-slate-400 dark:text-slate-500' }}">
                    {{ $expense->description ?: 'No description' }}
                </p>
            </div>
        @empty
            <div class="p-6">
                <x-ui.empty-state title="No expenses found" description="Try another search, month, or category." />
            </div>
        @endforelse
    </div>

    {{-- Desktop table --}}
    <div class="hidden overflow-x-auto md:block">
        <table class="w-full divide-y divide-slate-200 dark:divide-slate-700">
            <thead class="bg-slate-50 dark:bg-slate-900/40">
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-slate-400">
                        Date
                    </th>
                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-slate-400">
                        Category</th>
                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-slate-400">
                        Description</th>
                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wide text-right uppercase text-slate-500 dark:text-slate-400">
                        Amount
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-100 dark:divide-slate-700 dark:bg-slate-800">
                @forelse ($expenses as $expense)
                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">
                            {{ $expense->category?->name ?? 'Uncategorized' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                            {{ $expense->description ?: 'No description' }}
                        </td>

                        <td class="px-6 py-4 text-sm font-bold text-right text-slate-900 dark:text-slate-100">
                            RM {{ number_format($expense->amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8">
                            <x-ui.empty-state title="No expenses found"
                                description="Try another search, month, or category." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>
