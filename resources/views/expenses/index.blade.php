<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-900">
            Expenses
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto space-y-6 max-w-7xl">

            @if (session('success'))
                <div class="px-4 py-3 text-green-700 border border-green-500 rounded-lg bg-green-50">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 bg-white border border-slate-200 rounded-xl">
                <h3 class="mb-4 font-bold text-slate-900">Add Expense</h3>

                <form method="POST" action="{{ route('expenses.store') }}" class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    @csrf

                    <select name="category_id" class="rounded-lg border-slate-300">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number" step="0.01" name="amount" placeholder="Amount"
                        class="rounded-lg border-slate-300">

                    <input type="text" name="description" placeholder="Description"
                        class="rounded-lg border-slate-300">

                    <input type="date" name="expense_date" class="rounded-lg border-slate-300">

                    <button class="py-2 font-medium text-white bg-blue-600 rounded-lg md:col-span-4 hover:bg-blue-700">
                        Add Expense
                    </button>
                </form>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <h3 class="font-bold text-slate-900 mb-4">Filter Expenses</h3>

                <form method="GET" action="{{ route('expenses.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="month" name="month" value="{{ request('month', $selectedMonth) }}"
                        class="rounded-lg border-slate-300">

                    <select name="category_id" class="rounded-lg border-slate-300">
                        <option value="">All Categories</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex gap-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Filter
                        </button>

                        <a href="{{ route('expenses.index') }}"
                            class="border border-slate-200 text-slate-700 px-4 py-2 rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <h3 class="font-bold text-slate-900 mb-4">Monthly Summary by Category</h3>

                @forelse ($monthlySummary as $summary)
                    <div class="flex justify-between border-b border-slate-200 py-3">
                        <span class="text-slate-700">
                            {{ $summary->category->name }}
                        </span>

                        <span class="font-bold text-slate-900">
                            RM {{ number_format($summary->total, 2) }}
                        </span>
                    </div>
                @empty
                    <p class="text-slate-500">No summary available.</p>
                @endforelse
            </div>
            <div class="p-6 bg-white border border-slate-200 rounded-xl">
                <h3 class="mb-4 font-bold text-slate-900">Expense List</h3>

                <div class="space-y-3">
                    @forelse ($expenses as $expense)
                        <div class="flex items-center justify-between p-4 border rounded-lg border-slate-200">
                            <div>
                                <p class="font-semibold text-slate-900">
                                    RM {{ number_format($expense->amount, 2) }}
                                </p>
                                <p class="text-sm text-slate-500">
                                    {{ $expense->category->name }} • {{ $expense->expense_date }}
                                </p>
                                <p class="text-sm text-slate-700">
                                    {{ $expense->description }}
                                </p>
                            </div>
                            <div class="flex gap-4 items-center">
                                <a href="{{ route('expenses.edit', $expense) }}"
                                    class="text-blue-600 hover:text-blue-700 font-medium">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('expenses.destroy', $expense) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500">No expenses found.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
