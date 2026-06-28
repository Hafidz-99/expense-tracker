<x-ui.card title="Expense List" :description="Str::plural('record', $expenses->count(), true) . ' found.'" bodyClass="p-0 overflow-hidden">

    {{-- Mobile cards --}}
    <div class="divide-y divide-slate-100 md:hidden">
        @forelse ($expenses as $expense)
            <div class="p-5 space-y-3">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-slate-900">
                            {{ $expense->category?->name ?? 'Uncategorized' }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </p>
                    </div>

                    <p class="text-sm font-bold text-right text-slate-900 shrink-0">
                        RM {{ number_format($expense->amount, 2) }}
                    </p>
                </div>

                <p class="text-sm break-words {{ $expense->description ? 'text-slate-500' : 'italic text-slate-400' }}">
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
        <table class="w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500">Date
                    </th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500">
                        Category</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500">
                        Description</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-right uppercase text-slate-500">Amount
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($expenses as $expense)
                    <tr class="transition hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-slate-900">
                            {{ $expense->category?->name ?? 'Uncategorized' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ $expense->description ?: 'No description' }}
                        </td>

                        <td class="px-6 py-4 text-sm font-bold text-right text-slate-900">
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
