<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <h3 class="text-lg font-bold text-slate-900">
        Set Monthly Budget
    </h3>

    <p class="mt-1 text-sm text-slate-500">
        Add or update your budget for a selected month.
    </p>

    <form method="POST" action="{{ route('budgets.store') }}" class="mt-6 space-y-5">
        @csrf

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

            <input type="number" name="year" min="2020" max="2100" value="{{ old('year', now()->year) }}"
                class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                required>

            @error('year')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700">
            Save Budget
        </button>
    </form>
</div>
