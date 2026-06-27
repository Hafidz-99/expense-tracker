<x-ui.card bodyClass="p-0" title="Category List" :description="$categories->total() . ' categories found.'">
    <x-slot:actions>
        <form method="GET" action="{{ route('categories.index') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">

            <div class="flex items-center gap-3">
                <x-ui.label for="sort">
                    Sort
                </x-ui.label>

                <x-ui.select id="sort" name="sort" class="min-w-36">
                    <option value="az" @selected(request('sort', 'az') === 'az')>
                        A-Z
                    </option>

                    <option value="za" @selected(request('sort') === 'za')>
                        Z-A
                    </option>

                    <option value="latest" @selected(request('sort') === 'latest')>
                        Latest
                    </option>

                    <option value="oldest" @selected(request('sort') === 'oldest')>
                        Oldest
                    </option>
                </x-ui.select>
            </div>
        </form>
    </x-slot:actions>

    @forelse ($categories as $category)
        <div
            class="flex flex-col gap-4 px-6 py-4 transition-all duration-200 border-b border-slate-100 last:border-b-0 hover:bg-slate-50 hover:shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center min-w-0 gap-4">
                <div class="flex items-center justify-center w-12 h-12 font-bold text-white shadow-sm rounded-xl"
                    style="background-color: {{ $category->color ?? '#2563EB' }}">
                    {{ strtoupper(Str::substr($category->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-bold break-words text-slate-900">
                        {{ $category->name }}
                    </p>
                </div>
            </div>

            <div class="flex self-end w-full gap-2 shrink-0 sm:w-auto sm:self-center">
                <x-ui.button
                    size="sm"
                    variant="ghost"
                    type="button"
                    class="flex-1 sm:flex-none"
                    onclick="openEditCategoryModal(
                        '{{ route('categories.update', $category) }}',
                        '{{ addslashes($category->name) }}',
                        '{{ $category->color ?? '#2563EB' }}'
                    )">
                    Edit
                </x-ui.button>

                <x-ui.button
                    size="sm"
                    variant="danger"
                    type="button"
                    class="flex-1 sm:flex-none"
                    onclick="openDeleteCategoryModal(
                        '{{ route('categories.destroy', $category) }}',
                        '{{ addslashes($category->name) }}'
                    )">
                    Delete
                </x-ui.button>
            </div>
        </div>
    @empty
        <div class="p-6">
            <x-ui.empty-state
                title="No categories found"
                description="Try changing your search keyword or create a new category." />
        </div>
    @endforelse

    @if ($categories->hasPages())
        <x-slot:footer>
            <div class="flex justify-end">
                {{ $categories->links('vendor.pagination.custom') }}
            </div>
        </x-slot:footer>
    @endif
</x-ui.card>
