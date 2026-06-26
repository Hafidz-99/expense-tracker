<x-ui.card title="Search & Filter" description="Search expenses, refine the report, and export the results.">
    <form method="GET" action="{{ route('reports.index') }}">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Search
                </label>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Category or description..."
                    class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Month
                </label>

                <input type="month" name="month" value="{{ $selectedMonth }}"
                    class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Category
                </label>

                <select name="category_id"
                    class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Categories</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Sort
                </label>

                <select name="sort"
                    class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                    <option value="highest" @selected(request('sort') === 'highest')>Highest Amount</option>
                    <option value="lowest" @selected(request('sort') === 'lowest')>Lowest Amount</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-3 mt-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex flex-wrap gap-2">
                <x-ui.button type="submit">
                    Apply Filters
                </x-ui.button>

                <x-ui.button href="{{ route('reports.index') }}" variant="secondary">
                    Reset
                </x-ui.button>
            </div>

            <div class="flex flex-wrap gap-2">
                <x-ui.button href="{{ route('reports.print', request()->query()) }}" variant="secondary"
                    target="_blank">
                    Print
                </x-ui.button>

                <x-ui.button href="{{ route('reports.pdf', request()->query()) }}" variant="secondary">
                    PDF
                </x-ui.button>

                <x-ui.button href="{{ route('reports.excel', request()->query()) }}" variant="secondary">
                    Excel
                </x-ui.button>
            </div>
        </div>
    </form>
</x-ui.card>
