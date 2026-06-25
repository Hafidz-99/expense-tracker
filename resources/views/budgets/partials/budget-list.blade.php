<div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="px-6 py-4 border-b border-slate-200">
        <h3 class="text-lg font-bold text-slate-900">
            Budget History
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            View and manage your monthly budgets.
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Month
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Year
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Budget
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($budgets as $budget)
                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-4 text-slate-700">
                            {{ \Carbon\Carbon::create()->month($budget->month)->format('F') }}
                        </td>

                        <td class="px-6 py-4 text-slate-700">
                            {{ $budget->year }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-slate-900">
                            RM {{ number_format($budget->amount, 2) }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">

                                <button type="button"
                                    onclick="openEditBudgetModal(
                                        '{{ route('budgets.update', $budget) }}',
                                        '{{ $budget->amount }}',
                                        '{{ $budget->month }}',
                                        '{{ $budget->year }}'
                                    )"
                                    class="px-3 py-1.5 text-sm font-medium text-blue-600 transition border rounded-lg border-blue-200 hover:bg-blue-50">
                                    Edit
                                </button>

                                <button type="button"
                                    onclick="openDeleteBudgetModal(
                                        '{{ route('budgets.destroy', $budget) }}',
                                        '{{ \Carbon\Carbon::create()->month($budget->month)->format('F') }} {{ $budget->year }}'
                                    )"
                                    class="px-3 py-1.5 text-sm font-medium text-red-600 transition border rounded-lg border-red-200 hover:bg-red-50">
                                    Delete
                                </button>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center">
                            <div class="space-y-1">
                                <p class="font-semibold text-slate-700">
                                    No budgets found
                                </p>

                                <p class="text-sm text-slate-500">
                                    Create your first monthly budget to start tracking your spending.
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
