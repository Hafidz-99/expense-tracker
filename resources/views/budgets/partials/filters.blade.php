<x-ui.card title="Search & Filter" description="Filter budgets by year, status, and sorting order.">
    <form method="GET" action="{{ route('budgets.index') }}">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
            <div>
                <x-ui.label for="year">
                    Year
                </x-ui.label>

                <x-ui.input id="year" type="number" name="year" min="2020" max="2100"
                    value="{{ request('year') }}" placeholder="{{ now()->year }}" />
            </div>

            <div>
                <x-ui.label for="status">
                    Status
                </x-ui.label>

                <x-ui.select id="status" name="status" onchange="this.form.submit()">
                    <option value="all" @selected(request('status', 'all') === 'all')>
                        All Status
                    </option>

                    <option value="on_track" @selected(request('status') === 'on_track')>
                        On Track
                    </option>

                    <option value="near_limit" @selected(request('status') === 'near_limit')>
                        Near Limit
                    </option>

                    <option value="over_budget" @selected(request('status') === 'over_budget')>
                        Over Budget
                    </option>
                </x-ui.select>
            </div>

            <div>
                <x-ui.label for="sort">
                    Sort
                </x-ui.label>

                <x-ui.select id="sort" name="sort" onchange="this.form.submit()">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>
                        Latest
                    </option>

                    <option value="oldest" @selected(request('sort') === 'oldest')>
                        Oldest
                    </option>

                    <option value="highest" @selected(request('sort') === 'highest')>
                        Highest Budget
                    </option>

                    <option value="lowest" @selected(request('sort') === 'lowest')>
                        Lowest Budget
                    </option>
                </x-ui.select>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 mt-5 sm:flex-row sm:justify-end">
            <x-ui.button href="{{ route('budgets.index') }}" variant="secondary">
                Reset
            </x-ui.button>

            <x-ui.button type="submit">
                Apply Filters
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
