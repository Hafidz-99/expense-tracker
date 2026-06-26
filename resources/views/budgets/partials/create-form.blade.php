<x-ui.card title="Set Monthly Budget" description="Add or update your budget for a selected month.">
    <form method="POST" action="{{ route('budgets.store') }}" class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-slate-700">
                    Amount (RM)
                </label>

                <input type="number" name="amount" step="0.01" min="1" value="{{ old('amount') }}"
                    class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                    required>

                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">
                    Month
                </label>

                <select name="month"
                    class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                    required>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" @selected(old('month', now()->month) == $i)>
                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </select>

                @error('month')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">
                    Year
                </label>

                <input type="number" name="year" min="2020" max="2100"
                    value="{{ old('year', now()->year) }}"
                    class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                    required>

                @error('year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit" loading loadingText="Saving...">
                Save Budget
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
