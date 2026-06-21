<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-slate-800">Categories</h1>
    </x-slot>

    <div class="space-y-6">

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium rounded-xl">
                <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl">
                <svg class="w-4 h-4 shrink-0 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Page heading --}}
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800">Categories</h2>
            <p class="mt-1 text-sm text-slate-500">Group your expenses into categories for better insights.</p>
        </div>

        {{-- Add Category --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="text-sm font-bold text-slate-700">Add New Category</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1 space-y-1.5">
                            <label class="block text-xs font-semibold uppercase tracking-widest text-slate-400">
                                Category Name
                            </label>
                            <input type="text" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Food, Transport, Shopping"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-colors">
                            @error('name')
                                <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:self-end">
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Category List --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700">Your Categories</h3>
                <span class="text-xs text-slate-400 font-medium">{{ $categories->count() }} total</span>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($categories as $category)
                    <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-8 rounded-full bg-blue-400"></div>
                            <p class="text-sm font-semibold text-slate-800">{{ $category->name }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors"
                                        onclick="return confirm('Delete this category? This cannot be undone.')">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto w-10 h-10 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <p class="mt-2 text-sm font-medium text-slate-400">No categories yet.</p>
                        <p class="text-xs text-slate-300 mt-1">Add your first category using the form above.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
