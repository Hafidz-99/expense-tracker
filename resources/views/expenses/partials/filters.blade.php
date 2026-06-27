<x-ui.card title="Filters" description="Search and narrow down your expense records.">
    <form method="GET" action="{{ route('expenses.index') }}">
        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
            <div class="lg:col-span-3">
                <x-ui.label for="search">
                    Search
                </x-ui.label>

                <x-ui.input id="search" type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search description..." />
            </div>

            <div>
                <x-ui.label for="month">
                    Month
                </x-ui.label>

                <x-ui.select id="month" name="month">
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}" @selected((int) $selectedMonth === $month)>
                            {{ \Carbon\Carbon::create(null, $month, 1)->format('F') }}
                        </option>
                    @endforeach
                </x-ui.select>
            </div>

            <div>
                <x-ui.label for="year">
                    Year
                </x-ui.label>

                <x-ui.select id="year" name="year">
                    @foreach (range(now()->year, now()->year - 5) as $year)
                        <option value="{{ $year }}" @selected((int) $selectedYear === $year)>
                            {{ $year }}
                        </option>
                    @endforeach
                </x-ui.select>
            </div>

            <div>
                <x-ui.label for="category_id">
                    Category
                </x-ui.label>

                <x-ui.select id="category_id" name="category_id">
                    <option value="">All Categories</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-ui.select>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 mt-4 sm:flex-row sm:justify-end">
            <x-ui.button href="{{ route('expenses.index') }}" variant="secondary">
                Reset
            </x-ui.button>

            <x-ui.button type="submit">
                Apply Filters
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
