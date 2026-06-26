<x-ui.card title="Search" description="Search categories by name and sort the results.">
    <form method="GET" action="{{ route('categories.index') }}">
        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_auto_auto] md:items-end">
            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Search
                </label>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search category name..."
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
            </div>

            <x-ui.button href="{{ route('categories.index') }}" variant="secondary">
                Reset
            </x-ui.button>

            <x-ui.button type="submit">
                Apply
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
