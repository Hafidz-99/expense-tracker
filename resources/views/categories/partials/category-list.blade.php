<x-ui.card bodyClass="p-0" title="Category List" :description="$categories->total() . ' categories found.'">
    <x-slot:actions>
        <form method="GET" action="{{ route('categories.index') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">

            <div class="flex items-center gap-2">
                <span class="hidden text-sm font-medium text-slate-500 sm:block">
                    Sort
                </span>

                <select name="sort" onchange="this.form.submit()"
                    class="text-sm shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                    <option value="az" @selected(request('sort') === 'az')>A–Z</option>
                    <option value="za" @selected(request('sort') === 'za')>Z–A</option>
                </select>
            </div>
        </form>
    </x-slot:actions>

    @forelse ($categories as $category)
        <div
            class="flex flex-col gap-4 px-6 py-4 transition-colors duration-150 border-b border-slate-100 last:border-b-0 hover:bg-slate-50 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center min-w-0 gap-4">
                <div class="flex items-center justify-center font-bold text-white shadow-sm w-11 h-11 rounded-xl"
                    style="background-color: {{ $category->color ?? '#2563EB' }}">
                    {{ strtoupper(Str::substr($category->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-bold truncate text-slate-900">
                        {{ $category->name }}
                    </p>
                </div>
            </div>

            <div class="flex items-center self-end gap-2 shrink-0 sm:self-center">
                <x-ui.button size="sm" variant="ghost" type="button"
                    onclick="openEditCategoryModal(
                        '{{ route('categories.update', $category) }}',
                        '{{ addslashes($category->name) }}',
                        '{{ $category->color ?? '#2563EB' }}'
                    )">
                    Edit
                </x-ui.button>

                <x-ui.button size="sm" variant="danger" type="button"
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
            <x-ui.empty-state title="No categories found"
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
