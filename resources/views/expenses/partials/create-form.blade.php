<x-ui.card title="Add Expense" description="Record a new transaction.">
    <form method="POST" action="{{ route('expenses.store') }}">
        @csrf

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div>
                <x-ui.label for="category_id">
                    Category
                </x-ui.label>

                <x-ui.select id="category_id" name="category_id" required>
                    <option value="">Select category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-ui.select>

                <x-ui.form-error field="category_id" />
            </div>

            <div>
                <x-ui.label for="amount">
                    Amount (RM)
                </x-ui.label>

                <x-ui.input id="amount" type="number" name="amount" step="0.01" min="0.01"
                    value="{{ old('amount') }}" placeholder="0.00" required />

                <x-ui.form-error field="amount" />
            </div>

            <div>
                <x-ui.label for="description">
                    Description
                </x-ui.label>

                <x-ui.input id="description" type="text" name="description" value="{{ old('description') }}"
                    placeholder="Optional note..." />

                <x-ui.form-error field="description" />
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

        <div class="flex justify-end mt-4">
            <x-ui.button type="submit" loading loadingText="Saving...">
                Save Expense
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
