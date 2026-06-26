<x-ui.card title="Budget History" :description="$budgets->total() . ' budgets found.'" bodyClass="p-0">
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

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                        Status
                    </th>

                    <th class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($budgets as $budget)
                    <tr class="transition-colors duration-150 hover:bg-slate-50">
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
                            @if ($budget->status === 'over_budget')
                                <x-ui.badge variant="danger">Over Budget</x-ui.badge>
                            @elseif ($budget->status === 'near_limit')
                                <x-ui.badge variant="warning">Near Limit</x-ui.badge>
                            @else
                                <x-ui.badge variant="success">On Track</x-ui.badge>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <x-ui.button size="sm" variant="ghost" type="button"
                                    onclick="openEditBudgetModal(
                                        '{{ route('budgets.update', $budget) }}',
                                        '{{ $budget->amount }}',
                                        '{{ $budget->month }}',
                                        '{{ $budget->year }}'
                                    )">
                                    Edit
                                </x-ui.button>

                                <x-ui.button size="sm" variant="danger" type="button"
                                    onclick="openDeleteBudgetModal(
                                        '{{ route('budgets.destroy', $budget) }}',
                                        '{{ \Carbon\Carbon::create()->month($budget->month)->format('F') }} {{ $budget->year }}'
                                    )">
                                    Delete
                                </x-ui.button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6">
                            <x-ui.empty-state title="No budgets found"
                                description="Create your first monthly budget to start tracking your spending." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($budgets->hasPages())
        <x-slot:footer>
            <div class="flex justify-end">
                {{ $budgets->links('vendor.pagination.custom') }}
            </div>
        </x-slot:footer>
    @endif
</x-ui.card>
