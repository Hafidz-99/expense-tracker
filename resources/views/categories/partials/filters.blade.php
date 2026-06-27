<x-ui.card title="Search" description="Search categories by name and sort the results.">
    <form method="GET" action="{{ route('categories.index') }}">
        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_auto_auto] lg:items-end">
            <div>
                <x-ui.label for="search">
                    Search
                </x-ui.label>

                <x-ui.input
                    id="search"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search category name..." />
            </div>

            <div class="flex flex-col-reverse gap-3 lg:flex-row">
                <x-ui.button type="submit">
                    Apply
                </x-ui.button>

                <x-ui.button href="{{ route('categories.index') }}" variant="secondary">
                    Reset
                </x-ui.button>
            </div>
        </div>
    </form>
</x-ui.card>
