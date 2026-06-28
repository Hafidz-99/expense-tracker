<x-ui.card class="lg:col-span-2" title="Expense List" :description="$expenses->total() . ' records found.'" bodyClass="p-0">
    <x-slot:actions>
        <div class="flex items-center gap-3">
            <span class="hidden text-sm font-medium text-slate-500 sm:block">
                Sort
            </span>

            <form method="GET" action="{{ route('expenses.index') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">

                <x-ui.select name="sort" onchange="this.form.submit()"
                    class="text-sm bg-white shadow-sm min-w-36 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                    <option value="highest" @selected(request('sort') === 'highest')>Highest Amount</option>
                    <option value="lowest" @selected(request('sort') === 'lowest')>Lowest Amount</option>
                </x-ui.select>
            </form>
        </div>
    </x-slot:actions>

    @forelse ($expenses as $expense)
        <div
            class="flex flex-col gap-4 px-5 py-5 transition-colors duration-150 border-b border-slate-100 last:border-b-0 hover:bg-slate-50 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                    <p class="text-sm font-extrabold text-slate-900">
                        RM {{ number_format($expense->amount, 2) }}
                    </p>

                    <x-ui.badge
                        style="
                                    background-color: {{ $expense->category?->color ?? '#2563EB' }}20;
                                    color: {{ $expense->category?->color ?? '#2563EB' }};
                                ">
                        {{ $expense->category?->name ?? 'Unknown Category' }}
                    </x-ui.badge>
                </div>

                <div class="flex flex-wrap items-center gap-3 mt-1">
                    <p class="text-xs text-slate-500">
                        {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                    </p>

                    <p
                        class="max-w-sm text-xs break-words {{ $expense->description ? 'text-slate-500' : 'text-slate-400' }}">
                        {{ $expense->description ?: 'No description' }}
                    </p>
                </div>
            </div>

            <div class="flex w-full gap-2 sm:w-auto sm:self-center shrink-0">
                <x-ui.button class="flex-1 sm:flex-none" size="sm" variant="ghost" type="button"
                    onclick="openEditExpenseModal(
                                '{{ route('expenses.update', $expense) }}',
                                '{{ $expense->category_id }}',
                                '{{ $expense->amount }}',
                                '{{ addslashes($expense->description ?? '') }}',
                                '{{ $expense->expense_date }}'
                            )">
                    Edit
                </x-ui.button>

                <x-ui.button class="flex-1 sm:flex-none" size="sm" variant="danger" type="button"
                    onclick="openDeleteExpenseModal(
                                '{{ route('expenses.destroy', $expense) }}',
                                'RM {{ number_format($expense->amount, 2) }}',
                                '{{ addslashes($expense->category?->name ?? 'Unknown Category') }}'
                            )">
                    Delete
                </x-ui.button>
            </div>
        </div>
    @empty
        <div class="p-6">
            <x-ui.empty-state title="No expenses found"
                description="Try adjusting your filters or add your first expense." />
        </div>
    @endforelse
    @if ($expenses->hasPages())
        <x-slot:footer>
            <div class="flex justify-end">
                {{ $expenses->links('vendor.pagination.custom') }}
            </div>
        </x-slot:footer>
    @endif
</x-ui.card>
