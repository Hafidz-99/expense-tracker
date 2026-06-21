<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Dashboard</h1>
    </x-slot>

    <div class="space-y-6">

        {{-- Page intro --}}
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800">
                Welcome back, {{ Auth::user()->name }}
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Here is your spending summary for {{ now()->format('F Y') }}.
            </p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">This Month</p>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">RM {{ number_format($monthlyTotal, 2) }}</p>
                <p class="mt-1 text-xs text-slate-400">Total for {{ now()->format('F Y') }}</p>
                <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                    <div class="h-1 w-3/4 bg-blue-500 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Today</p>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">RM {{ number_format($todayTotal, 2) }}</p>
                <p class="mt-1 text-xs text-slate-400">Spent on {{ now()->format('d M Y') }}</p>
                <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                    <div class="h-1 w-1/4 bg-blue-500 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">All Transactions</p>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $totalTransactions }}</p>
                <p class="mt-1 text-xs text-slate-400">Recorded all-time</p>
                <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                    <div class="h-1 w-2/3 bg-emerald-500 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Top Category</p>

                @if ($topCategory)
                    <p class="mt-2 text-3xl font-extrabold text-slate-800">
                        {{ $topCategory->category->name }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">
                        RM {{ number_format($topCategory->total, 2) }} this month
                    </p>
                @else
                    <p class="mt-2 text-3xl font-extrabold text-slate-800">
                        -
                    </p>
                    <p class="mt-1 text-xs text-slate-400">
                        No expenses this month
                    </p>
                @endif

                <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                    <div class="h-1 w-1/2 bg-blue-600 rounded-full"></div>
                </div>
            </div>

        </div>

        {{-- Recent Expenses --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-800">Recent Expenses</h3>
                <a href="{{ route('expenses.index') }}"
                   class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                    View all
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse ($recentExpenses as $expense)
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-800 truncate">
                                {{ $expense->description ?? 'No description' }}
                            </p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    {{ $expense->category->name }}
                                </span>
                                <span class="text-xs text-slate-400">
                                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <p class="ml-4 shrink-0 text-sm font-bold text-slate-800">
                            RM {{ number_format($expense->amount, 2) }}
                        </p>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm text-slate-400 font-medium">No expenses recorded yet.</p>
                        <a href="{{ route('expenses.index') }}"
                           class="mt-3 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                            Add your first expense
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <a href="{{ route('expenses.index') }}"
               class="group flex items-center gap-4 bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-blue-300 hover:shadow-md transition-all">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Add Expense</p>
                    <p class="text-xs text-slate-400 mt-0.5">Record a new transaction</p>
                </div>
            </a>

            <a href="{{ route('categories.index') }}"
               class="group flex items-center gap-4 bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-blue-300 hover:shadow-md transition-all">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Manage Categories</p>
                    <p class="text-xs text-slate-400 mt-0.5">Organise your spending</p>
                </div>
            </a>

        </div>

    </div>
</x-app-layout>
