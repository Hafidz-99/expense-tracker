<x-ui.modal id="dashboardViewOptionsModal" title="Customize Dashboard">
    <form id="dashboardViewOptionsForm" method="POST" action="{{ route('dashboard.preferences.update') }}"
        class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <h3 class="text-sm font-semibold text-slate-900">
                Dashboard Sections
            </h3>
            <p class="mt-1 text-sm text-slate-500">
                Choose which sections should appear on your dashboard.
            </p>
        </div>

        <div class="space-y-3">
            <label class="flex items-start gap-3 p-4 border rounded-xl border-slate-200">
                <input type="checkbox" name="show_budget_progress" value="1"
                    class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                    @checked(old('show_budget_progress', $setting?->show_budget_progress ?? true))>

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
                    @checked(old('show_category_breakdown', $setting?->show_category_breakdown ?? true))>

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
                    @checked(old('show_recent_expenses', $setting?->show_recent_expenses ?? true))>

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

        <div>
            <x-ui.label for="recent_expenses_count">
                Recent Expenses Count
            </x-ui.label>

            <x-ui.select id="recent_expenses_count" name="recent_expenses_count">
                @foreach ([3, 5, 8, 10] as $count)
                    <option value="{{ $count }}" @selected(old('recent_expenses_count', $setting?->recent_expenses_count ?? 5) == $count)>
                        Show {{ $count }} recent expenses
                    </option>
                @endforeach
            </x-ui.select>

            <x-ui.form-error field="recent_expenses_count" />
        </div>
    </form>

    <x-slot:footer>
        <div class="flex justify-end gap-3">
            <x-ui.button variant="secondary" type="button" onclick="closeDashboardPreferencesModal()">
                Cancel
            </x-ui.button>

            <x-ui.button type="submit" form="dashboardViewOptionsForm">
                Save Changes
            </x-ui.button>
        </div>
    </x-slot:footer>
</x-ui.modal>

<script>
    function openDashboardPreferencesModal() {
        document.getElementById('dashboardViewOptionsModal').classList.remove('hidden');
    }

    function closeDashboardPreferencesModal() {
        document.getElementById('dashboardViewOptionsModal').classList.add('hidden');
    }
</script>
