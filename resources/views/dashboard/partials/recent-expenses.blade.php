<div class="overflow-hidden bg-white border shadow-sm lg:col-span-2 border-slate-200 rounded-2xl">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">
                Recent Expenses
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Latest transactions you recorded.
            </p>
        </div>

        <a href="{{ route('expenses.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
            View all
        </a>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse ($recentExpenses as $expense)
            <div class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-slate-50">
                <div class="min-w-0">
                    <p class="text-sm font-bold truncate text-slate-900">
                        {{ $expense->description ?: 'No description' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-2 mt-1">
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600">
                            {{ $expense->category->name }}
                        </span>

                        <span class="text-xs text-slate-500">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                        </span>
                    </div>
                </div>

                <p class="text-sm font-extrabold shrink-0 text-slate-900">
                    RM {{ number_format($expense->amount, 2) }}
                </p>
            </div>
        @empty
            <div class="px-6 py-12 text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto text-blue-600 rounded-2xl bg-blue-50">
                    +
                </div>

                <h3 class="mt-4 text-sm font-bold text-slate-900">
                    No expenses yet
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Start by adding your first expense.
                </p>

                <a href="{{ route('expenses.index') }}"
                    class="inline-flex items-center px-4 py-2 mt-4 text-sm font-semibold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
                    Add Expense
                </a>
            </div>
        @endforelse
    </div>
</div>
