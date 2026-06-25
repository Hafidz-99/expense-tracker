<div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="px-6 py-4 border-b border-slate-200">
        <h2 class="text-base font-bold text-slate-900">
            Add Expense
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Record a new transaction.
        </p>
    </div>

    <form method="POST" action="{{ route('expenses.store') }}" class="p-6">
        @csrf

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Category
                </label>

                <select name="category_id"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    <option value="">Select category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Amount
                </label>

                <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" placeholder="0.00"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                @error('amount')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Description
                </label>

                <input type="text" name="description" value="{{ old('description') }}"
                    placeholder="What was this for?"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                @error('description')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Date
                </label>

                <input type="date" name="expense_date" value="{{ old('expense_date', now()->format('Y-m-d')) }}"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                @error('expense_date')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end mt-5">
            <button type="submit"
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                Save Expense
            </button>
        </div>
    </form>
</div>
