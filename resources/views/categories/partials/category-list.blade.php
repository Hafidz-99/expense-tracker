<div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">Category List</h2>
            <p class="mt-1 text-sm text-slate-500">
                {{ $categories->count() }} categories created.
            </p>
        </div>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse ($categories as $category)
            <div class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-slate-50">
                <div class="flex items-center min-w-0 gap-4">
                    <div class="flex items-center justify-center font-bold text-white border w-11 h-11 rounded-xl border-slate-200 shrink-0"
                        style="background-color: {{ $category->color ?? '#2563EB' }}">
                        {{ strtoupper(substr($category->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <p class="text-sm font-bold truncate text-slate-900">
                            {{ $category->name }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button"
                        onclick="openEditCategoryModal(
                                '{{ route('categories.update', $category) }}',
                                '{{ addslashes($category->name) }}',
                                '{{ $category->color ?? '#2563EB' }}'
                            )"
                        class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                        Edit
                    </button>

                    <form method="POST" action="{{ route('categories.destroy', $category) }}">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            onclick="openDeleteCategoryModal(
                                '{{ route('categories.destroy', $category) }}',
                                '{{ addslashes($category->name) }}'
                            )"
                            class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="px-6 text-center py-14">
                <div class="flex items-center justify-center w-12 h-12 mx-auto text-blue-600 rounded-2xl bg-blue-50">
                    +
                </div>

                <h3 class="mt-4 text-sm font-bold text-slate-900">
                    No categories yet
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Create your first category using the form above.
                </p>
            </div>
        @endforelse
    </div>
</div>
