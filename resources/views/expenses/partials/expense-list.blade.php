<div class="overflow-hidden bg-white border shadow-sm lg:col-span-2 border-slate-200 rounded-2xl">
    <div class="flex flex-col gap-4 px-6 py-4 border-b border-slate-200 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-base font-bold text-slate-900">
                Expense List
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $expenses->total() }} records found.
            </p>
        </div>

        <form method="GET" action="{{ route('expenses.index') }}" class="flex items-center gap-2">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="month" value="{{ request('month', $selectedMonth) }}">
            <input type="hidden" name="year" value="{{ request('year', $selectedYear) }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">

            <label class="text-sm font-semibold text-slate-700">
                Sort
            </label>

            <select name="sort" onchange="this.form.submit()"
                class="text-sm shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                <option value="highest" @selected(request('sort') === 'highest')>Highest amount</option>
                <option value="lowest" @selected(request('sort') === 'lowest')>Lowest amount</option>
            </select>
        </form>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse ($expenses as $expense)
            <div class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-slate-50">
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="text-sm font-extrabold text-slate-900">
                            RM {{ number_format($expense->amount, 2) }}
                        </p>

                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold"
                            style="background-color: {{ $expense->category->color ?? '#DBEAFE' }}20; color: {{ $expense->category->color ?? '#2563EB' }}">
                            {{ $expense->category->name }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 mt-1">
                        <p class="text-xs text-slate-500">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </p>

                        @if ($expense->description)
                            <p class="max-w-sm text-xs truncate text-slate-500">
                                {{ $expense->description }}
                            </p>
                        @else
                            <p class="text-xs text-slate-400">
                                No description
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button"
                        onclick="openEditExpenseModal(
                            '{{ route('expenses.update', $expense) }}',
                            '{{ $expense->category_id }}',
                            '{{ $expense->amount }}',
                            '{{ addslashes($expense->description ?? '') }}',
                            '{{ $expense->expense_date }}'
                        )"
                        class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                        Edit
                    </button>

                    <button type="button"
                        onclick="openDeleteExpenseModal(
                                '{{ route('expenses.destroy', $expense) }}',
                                'RM {{ number_format($expense->amount, 2) }}',
                                '{{ addslashes($expense->category->name) }}'
                            )"
                        class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="px-6 text-center py-14">
                <div class="flex items-center justify-center w-12 h-12 mx-auto text-blue-600 rounded-2xl bg-blue-50">
                    +
                </div>

                <h3 class="mt-4 text-sm font-bold text-slate-900">
                    No expenses found
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Add your first expense or adjust your filters.
                </p>
            </div>
        @endforelse
    </div>
    @if ($expenses->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $expenses->links('vendor.pagination.custom') }}
        </div>
    @endif
</div>
