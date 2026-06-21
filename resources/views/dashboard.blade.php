<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-900">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto space-y-6 max-w-7xl">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="p-6 bg-white border border-slate-200 rounded-xl">
                    <p class="text-sm text-slate-500">This Month</p>
                    <h3 class="text-2xl font-bold text-slate-900">
                        RM {{ number_format($monthlyTotal, 2) }}
                    </h3>
                </div>

                <div class="p-6 bg-white border border-slate-200 rounded-xl">
                    <p class="text-sm text-slate-500">Today</p>
                    <h3 class="text-2xl font-bold text-slate-900">
                        RM {{ number_format($todayTotal, 2) }}
                    </h3>
                </div>

                <div class="p-6 bg-white border border-slate-200 rounded-xl">
                    <p class="text-sm text-slate-500">Transactions</p>
                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ $totalTransactions }}
                    </h3>
                </div>
            </div>

            <div class="p-6 bg-white border border-slate-200 rounded-xl">
                <h3 class="mb-4 font-bold text-slate-900">Recent Expenses</h3>

                @forelse ($recentExpenses as $expense)
                    <div class="flex justify-between py-3 border-b border-slate-200">
                        <div>
                            <p class="font-medium text-slate-900">
                                {{ $expense->description ?? 'No description' }}
                            </p>
                            <p class="text-sm text-slate-500">
                                {{ $expense->category->name }} • {{ $expense->expense_date }}
                            </p>
                        </div>

                        <p class="font-bold text-slate-900">
                            RM {{ number_format($expense->amount, 2) }}
                        </p>
                    </div>
                @empty
                    <p class="text-slate-500">No expenses yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
