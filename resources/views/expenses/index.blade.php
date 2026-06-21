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

                            <form method="POST" action="{{ route('expenses.destroy', $expense) }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-500 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-slate-500">No expenses found.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
