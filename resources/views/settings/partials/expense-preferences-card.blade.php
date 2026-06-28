<x-ui.card title="Expense Preferences" description="Configure default expense behavior.">
    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-ui.label for="default_category_id">Default Category</x-ui.label>
                <x-ui.select id="default_category_id" name="default_category_id">
                    <option value="">No default category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('default_category_id', $setting->default_category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-ui.select>
                <x-ui.form-error field="default_category_id" />
            </div>

            <div>
                <x-ui.label for="default_expense_date">Default Expense Date</x-ui.label>
                <x-ui.select id="default_expense_date" name="default_expense_date">
                    <option value="today" @selected(old('default_expense_date', $setting->default_expense_date) === 'today')>
                        Today
                    </option>
                    <option value="blank" @selected(old('default_expense_date', $setting->default_expense_date) === 'blank')>
                        Blank
                    </option>
                </x-ui.select>
                <x-ui.form-error field="default_expense_date" />
            </div>

            <div>
                <x-ui.label for="decimal_precision">Decimal Precision</x-ui.label>
                <x-ui.select id="decimal_precision" name="decimal_precision">
                    @foreach ([0, 1, 2, 3, 4] as $precision)
                        <option value="{{ $precision }}" @selected(old('decimal_precision', $setting->decimal_precision) == $precision)>
                            {{ $precision }} decimal {{ $precision === 1 ? 'place' : 'places' }}
                        </option>
                    @endforeach
                </x-ui.select>
                <x-ui.form-error field="decimal_precision" />
            </div>

            <div>
                <x-ui.label for="first_day_of_week">First Day of Week</x-ui.label>
                <x-ui.select id="first_day_of_week" name="first_day_of_week">
                    <option value="0" @selected(old('first_day_of_week', $setting->first_day_of_week) == 0)>Sunday</option>
                    <option value="1" @selected(old('first_day_of_week', $setting->first_day_of_week) == 1)>Monday</option>
                    <option value="6" @selected(old('first_day_of_week', $setting->first_day_of_week) == 6)>Saturday</option>
                </x-ui.select>
                <x-ui.form-error field="first_day_of_week" />
            </div>

            <label class="flex items-start gap-3 p-4 border rounded-xl border-slate-200 md:col-span-2">
                <input type="checkbox" name="monthly_budget_reminder" value="1"
                    class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    @checked(old('monthly_budget_reminder', $setting->monthly_budget_reminder))>

                <span>
                    <span class="block text-sm font-semibold text-slate-700">
                        Monthly Budget Reminder
                    </span>
                    <span class="block mt-1 text-sm text-slate-500">
                        Remind me to review my monthly budget.
                    </span>
                </span>
            </label>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit">
                Save Expense Preferences
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
