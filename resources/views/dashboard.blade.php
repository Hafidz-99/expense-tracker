<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Dashboard
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                View your spending overview and recent activity.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm font-semibold text-slate-500">This Month</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    RM {{ number_format($monthlyTotal, 2) }}
                </p>
                <p class="mt-2 text-sm text-slate-500">
                    Total spending in {{ now()->format('F Y') }}
                </p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm font-semibold text-slate-500">Today</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    RM {{ number_format($todayTotal, 2) }}
                </p>
                <p class="mt-2 text-sm text-slate-500">
                    Spending for {{ now()->format('d M Y') }}
                </p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm font-semibold text-slate-500">Transactions</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ $totalTransactions }}
                </p>
                <p class="mt-2 text-sm text-slate-500">
                    Total expenses recorded
                </p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <p class="text-sm font-semibold text-slate-500">Top Category</p>

                @if ($topCategory)
                    <p class="mt-3 text-3xl font-extrabold text-slate-900">
                        {{ $topCategory->category->name }}
                    </p>
                    <p class="mt-2 text-sm text-slate-500">
                        RM {{ number_format($topCategory->total, 2) }} this month
                    </p>
                @else
                    <p class="mt-3 text-3xl font-extrabold text-slate-900">
                        -
                    </p>
                    <p class="mt-2 text-sm text-slate-500">
                        No expenses this month
                    </p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Recent Expenses
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Latest transactions you recorded.
                        </p>
                    </div>

                    <a href="{{ route('expenses.index') }}"
                       class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                        View all
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($recentExpenses as $expense)
                        <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">
                                    {{ $expense->description ?: 'No description' }}
                                </p>

                                <div class="mt-1 flex items-center gap-2 flex-wrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600">
                                        {{ $expense->category->name }}
                                    </span>

                                    <span class="text-xs text-slate-500">
                                        {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <p class="shrink-0 text-sm font-extrabold text-slate-900">
                                RM {{ number_format($expense->amount, 2) }}
                            </p>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <div class="mx-auto w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                +
                            </div>

                            <h3 class="mt-4 text-sm font-bold text-slate-900">
                                No expenses yet
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Start by adding your first expense.
                            </p>

                            <a href="{{ route('expenses.index') }}"
                               class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                                Add Expense
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Monthly Spending
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Breakdown by category.
                        </p>
                    </div>

                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">
                        {{ now()->format('M Y') }}
                    </span>
                </div>

                <div class="mt-6 space-y-5">
                    @forelse ($categoryBreakdown as $item)
                        @php
                            $percentage = $monthlyTotal > 0
                                ? round(($item->total / $monthlyTotal) * 100)
                                : 0;
                        @endphp

                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm font-semibold text-slate-700 truncate">
                                    {{ $item->category->name }}
                                </p>

                                <p class="text-sm font-bold text-slate-900 shrink-0">
                                    RM {{ number_format($item->total, 2) }}
                                </p>
                            </div>

                            <div class="mt-2 flex items-center gap-3">
                                <div class="h-2 flex-1 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-blue-600"
                                        style="width: {{ $percentage }}%"></div>
                                </div>

                                <span class="w-10 text-right text-xs font-semibold text-slate-500">
                                    {{ $percentage }}%
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <div class="mx-auto w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                %
                            </div>

                            <h3 class="mt-4 text-sm font-bold text-slate-900">
                                No category data
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Add expenses to see your spending breakdown.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>