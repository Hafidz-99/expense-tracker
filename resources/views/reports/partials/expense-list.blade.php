<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <h2 class="text-lg font-bold text-slate-900">Expense List</h2>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead>
                <tr class="text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                    <th class="py-3 pr-4">Date</th>
                    <th class="py-3 pr-4">Category</th>
                    <th class="py-3 pr-4">Note</th>
                    <th class="py-3 text-right">Amount</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse ($expenses as $expense)
                    <tr>
                        <td class="py-4 pr-4 text-sm text-slate-700">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </td>

                        <td class="py-4 pr-4 text-sm text-slate-700">
                            {{ $expense->category->name ?? 'Uncategorized' }}
                        </td>

                        <td class="py-4 pr-4 text-sm text-slate-500">
                            {{ $expense->note ?? '-' }}
                        </td>

                        <td class="py-4 text-sm font-semibold text-right text-slate-900">
                            RM {{ number_format($expense->amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-sm text-center text-slate-500">
                            No expenses found for this period.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
