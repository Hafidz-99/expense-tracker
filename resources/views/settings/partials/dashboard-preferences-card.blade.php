<x-ui.card title="Dashboard Preferences" description="Choose how your dashboard should behave.">
    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-ui.label for="default_dashboard_period">Default Dashboard Period</x-ui.label>
                <x-ui.select id="default_dashboard_period" name="default_dashboard_period">
                    <option value="monthly" @selected(old('default_dashboard_period', $setting->default_dashboard_period) === 'monthly')>
                        Monthly
                    </option>
                    <option value="yearly" @selected(old('default_dashboard_period', $setting->default_dashboard_period) === 'yearly')>
                        Yearly
                    </option>
                    <option value="all_time" @selected(old('default_dashboard_period', $setting->default_dashboard_period) === 'all_time')>
                        All Time
                    </option>
                </x-ui.select>
                <x-ui.form-error field="default_dashboard_period" />
            </div>

            <div>
                <x-ui.label for="recent_expenses_count">Recent Expenses Count</x-ui.label>
                <x-ui.select id="recent_expenses_count" name="recent_expenses_count">
                    @foreach ([3, 5, 8, 10] as $count)
                        <option value="{{ $count }}" @selected(old('recent_expenses_count', $setting->recent_expenses_count) == $count)>
                            Show {{ $count }} recent expenses
                        </option>
                    @endforeach
                </x-ui.select>
                <x-ui.form-error field="recent_expenses_count" />
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <label class="flex items-start gap-3 p-4 border rounded-xl border-slate-200">
                <input type="checkbox" name="show_budget_progress" value="1"
                    class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    @checked(old('show_budget_progress', $setting->show_budget_progress))>

                <span>
                    <span class="block text-sm font-semibold text-slate-700">
                        Budget Progress
                    </span>
                    <span class="block mt-1 text-sm text-slate-500">
                        Show monthly budget usage.
                    </span>
                </span>
            </label>

            <label class="flex items-start gap-3 p-4 border rounded-xl border-slate-200">
                <input type="checkbox" name="show_category_breakdown" value="1"
                    class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    @checked(old('show_category_breakdown', $setting->show_category_breakdown))>

                <span>
                    <span class="block text-sm font-semibold text-slate-700">
                        Category Breakdown
                    </span>
                    <span class="block mt-1 text-sm text-slate-500">
                        Show spending by category.
                    </span>
                </span>
            </label>

            <label class="flex items-start gap-3 p-4 border rounded-xl border-slate-200">
                <input type="checkbox" name="show_recent_expenses" value="1"
                    class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    @checked(old('show_recent_expenses', $setting->show_recent_expenses))>

                <span>
                    <span class="block text-sm font-semibold text-slate-700">
                        Recent Expenses
                    </span>
                    <span class="block mt-1 text-sm text-slate-500">
                        Show your latest expenses.
                    </span>
                </span>
            </label>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit">
                Save Dashboard Preferences
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
