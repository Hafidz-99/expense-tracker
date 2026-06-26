<x-ui.card title="Search & Filter" description="Filter budgets by year, status, and sorting order.">
    <form method="GET" action="{{ route('budgets.index') }}">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-slate-700">
                    Year
                </label>

                <input type="number" name="year" min="2020" max="2100" value="{{ request('year') }}"
                    placeholder="{{ now()->year }}"
                    class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">
                    Status
                </label>

                <select name="status"
                    class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    <option value="all" @selected(request('status', 'all') === 'all')>All Status</option>
                    <option value="on_track" @selected(request('status') === 'on_track')>On Track</option>
                    <option value="near_limit" @selected(request('status') === 'near_limit')>Near Limit</option>
                    <option value="over_budget" @selected(request('status') === 'over_budget')>Over Budget</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">
                    Sort
                </label>

                <select name="sort"
                    class="block w-full mt-1 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                    <option value="highest" @selected(request('sort') === 'highest')>Highest Budget</option>
                    <option value="lowest" @selected(request('sort') === 'lowest')>Lowest Budget</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-5">
            <x-ui.button href="{{ route('budgets.index') }}" variant="secondary">
                Reset
            </x-ui.button>

            <x-ui.button type="submit">
                Apply Filters
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
