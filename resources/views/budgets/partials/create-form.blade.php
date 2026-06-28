<x-ui.card title="Set Monthly Budget" description="Add or update your budget for a selected month.">
    <form method="POST" action="{{ route('budgets.store') }}" class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
            <div>
                <x-ui.label for="amount">
                    Amount (RM)
                </x-ui.label>

                <x-ui.input id="amount" type="number" name="amount" step="0.01" min="1"
                    value="{{ old('amount') }}" required />

                <x-ui.form-error field="amount" />
            </div>

            <div>
                <x-ui.label for="month">
                    Month
                </x-ui.label>

                <x-ui.select id="month" name="month" required>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" @selected(old('month', now()->month) == $i)>
                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </x-ui.select>

                <x-ui.form-error field="month" />
            </div>

            <div>
                <x-ui.label for="year">
                    Year
                </x-ui.label>

                <x-ui.input id="year" type="number" name="year" min="2020" max="2100"
                    value="{{ old('year', now()->year) }}" required />

                <x-ui.form-error field="year" />
            </div>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit" class="w-full sm:w-auto">
                Save Budget
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
