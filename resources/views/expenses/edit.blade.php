<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-900">
            Edit Expense
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <form method="POST" action="{{ route('expenses.update', $expense) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Category
                        </label>

                        <select name="category_id" class="w-full rounded-lg border-slate-300">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($expense->category_id == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Amount
                        </label>

                        <input type="number" step="0.01" name="amount"
                            value="{{ $expense->amount }}"
                            class="w-full rounded-lg border-slate-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Description
                        </label>

                        <input type="text" name="description"
                            value="{{ $expense->description }}"
                            class="w-full rounded-lg border-slate-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Date
                        </label>

                        <input type="date" name="expense_date"
                            value="{{ $expense->expense_date }}"
                            class="w-full rounded-lg border-slate-300">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('expenses.index') }}"
                            class="border border-slate-200 px-4 py-2 rounded-lg text-slate-700">
                            Cancel
                        </a>

                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Update Expense
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>