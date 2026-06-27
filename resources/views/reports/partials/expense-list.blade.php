<x-ui.card title="Expense List" :description="Str::plural('record', $expenses->count(), true) . ' found.'" bodyClass="p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Date
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Category
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Description
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500">
                        Amount
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-100">
                @forelse ($expenses as $expense)
                    <tr class="transition-all duration-200 hover:bg-slate-50 hover:shadow-sm">
                        <td class="px-6 py-4 text-sm text-slate-700">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-700">
                            {{ $expense->category?->name ?? 'Uncategorized' }}
                        </td>

                        <td
                            class="px-6 py-4 text-sm break-words max-w-xs {{ $expense->description ? 'text-slate-500' : 'italic text-slate-400' }}">
                            {{ $expense->description ?: 'No description' }}
                        </td>

                        <td class="px-6 py-4 text-sm font-semibold text-right text-slate-900">
                            RM {{ number_format($expense->amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6">
                            <x-ui.empty-state title="No expenses found"
                                description="Try another search, month, or category." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>
