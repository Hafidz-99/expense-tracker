<x-ui.card title="Budget History" :description="$budgets->total() . ' budgets found.'" bodyClass="p-0 overflow-hidden">

    {{-- Mobile cards --}}
    <div class="divide-y divide-slate-100 dark:divide-slate-700 md:hidden">
        @forelse ($budgets as $budget)
            <div class="p-5 space-y-4 transition-colors duration-150 hover:bg-slate-50 dark:hover:bg-slate-700/40">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ \Carbon\Carbon::create()->month($budget->month)->format('F') }} {{ $budget->year }}
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-300">
                            RM {{ number_format($budget->amount, 2) }}
                        </p>
                    </div>

                    <div class="shrink-0">
                        @if ($budget->status === 'over_budget')
                            <x-ui.badge variant="danger">Over Budget</x-ui.badge>
                        @elseif ($budget->status === 'near_limit')
                            <x-ui.badge variant="warning">Near Limit</x-ui.badge>
                        @else
                            <x-ui.badge variant="success">On Track</x-ui.badge>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <x-ui.button size="sm" variant="ghost" type="button" class="w-full"
                        onclick="openEditBudgetModal(
                            '{{ route('budgets.update', $budget) }}',
                            '{{ $budget->amount }}',
                            '{{ $budget->month }}',
                            '{{ $budget->year }}'
                        )">
                        Edit
                    </x-ui.button>

                    <x-ui.button size="sm" variant="danger" type="button" class="w-full"
                        onclick="openDeleteBudgetModal(
                            '{{ route('budgets.destroy', $budget) }}',
                            '{{ \Carbon\Carbon::create()->month($budget->month)->format('F') }} {{ $budget->year }}'
                        )">
                        Delete
                    </x-ui.button>
                </div>
            </div>
        @empty
            <div class="p-6">
                <x-ui.empty-state title="No budgets found"
                    description="Create your first monthly budget to start tracking your spending." />
            </div>
        @endforelse
    </div>

    {{-- Desktop table --}}
    <div class="hidden overflow-x-auto md:block">
        <table class="w-full divide-y divide-slate-200 dark:divide-slate-700">
            <thead class="bg-slate-50 dark:bg-slate-900/40">
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500 dark:text-slate-400">
                        Month
                    </th>

                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500 dark:text-slate-400">
                        Year
                    </th>

                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500 dark:text-slate-400">
                        Budget
                    </th>

                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500 dark:text-slate-400">
                        Status
                    </th>

                    <th
                        class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500 dark:text-slate-400">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-100 dark:divide-slate-700 dark:bg-slate-800">
                @forelse ($budgets as $budget)
                    <tr class="transition-colors duration-150 hover:bg-slate-50 dark:hover:bg-slate-700/40">
                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                            {{ \Carbon\Carbon::create()->month($budget->month)->format('F') }}
                        </td>

                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                            {{ $budget->year }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-slate-900 dark:text-slate-100">
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

                        <td class="px-6 py-4 text-right">
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

    @if ($budgets->total() > 0)
        <x-slot:footer>
            <div class="flex justify-end" data-ajax-pagination>
                {{ $budgets->links('vendor.pagination.custom') }}
            </div>
        </x-slot:footer>
    @endif
</x-ui.card>
