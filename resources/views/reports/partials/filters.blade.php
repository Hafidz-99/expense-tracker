<x-ui.card title="Search & Filter" description="Search expenses, refine the report, and export the results.">
    <form method="GET" action="{{ route('reports.index') }}">
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-6">
            <div class="lg:col-span-2">
                <x-ui.label for="search">
                    Search
                </x-ui.label>

                <x-ui.input id="search" type="text" name="search" value="{{ request('search') }}"
                    placeholder="Category or description..." />
            </div>

            <div>
                <x-ui.label for="month">
                    Month
                </x-ui.label>

                <x-ui.input id="month" type="month" name="month" value="{{ $selectedMonth }}" />
            </div>

            <div>
                <x-ui.label for="category_id">
                    Category
                </x-ui.label>

                <x-ui.select id="category_id" name="category_id" onchange="this.form.submit()">
                    <option value="">All Categories</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-ui.select>
            </div>

            <div>
                <x-ui.label for="sort">
                    Sort
                </x-ui.label>

                <x-ui.select id="sort" name="sort" class="min-w-36" onchange="this.form.submit()">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>
                        Latest
                    </option>

                    <option value="oldest" @selected(request('sort') === 'oldest')>
                        Oldest
                    </option>

                    <option value="highest" @selected(request('sort') === 'highest')>
                        Highest Amount
                    </option>

                    <option value="lowest" @selected(request('sort') === 'lowest')>
                        Lowest Amount
                    </option>
                </x-ui.select>
            </div>
        </div>

        <div class="flex flex-col gap-4 mt-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex flex-col-reverse gap-3 sm:flex-row">
                <x-ui.button type="submit">
                    Apply Filters
                </x-ui.button>

                <x-ui.button href="{{ route('reports.index') }}" variant="secondary">
                    Reset
                </x-ui.button>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.button type="button" variant="secondary" onclick="openReportExportModal()">
                    Export
                </x-ui.button>

                <x-ui.button type="button" variant="secondary" onclick="openReportImportModal()">
                    Import
                </x-ui.button>
            </div>
        </div>
    </form>
</x-ui.card>
