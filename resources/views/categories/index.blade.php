<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Categories
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Organize your expenses using simple icons and colors.
            </p>
        </div>
    </x-slot>

    @php
        $colors = [
            '#2563EB' => 'Blue',
            '#22C55E' => 'Green',
            '#F59E0B' => 'Amber',
            '#EF4444' => 'Red',
            '#8B5CF6' => 'Purple',
            '#EC4899' => 'Pink',
            '#64748B' => 'Slate',
        ];
    @endphp

    <div class="space-y-6">

        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-base font-bold text-slate-900">
                    Add Category
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Choose a name and color for your category.
                </p>
            </div>

            <form method="POST" action="{{ route('categories.store') }}" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Category Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Food"
                               class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

                        @error('name')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Color
                        </label>

                        <select name="color"
                                class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                            @foreach ($colors as $hex => $label)
                                <option value="{{ $hex }}" @selected(old('color', '#2563EB') === $hex)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        @error('color')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 flex justify-end">
                    <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                        Add Category
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">
                        Category List
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $categories->count() }} categories created.
                    </p>
                </div>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse ($categories as $category)
                    <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition">
                        <div class="flex items-center gap-4 min-w-0">
                            <div
                                class="w-11 h-11 rounded-xl flex items-center justify-center text-white font-bold border border-slate-200 shrink-0"
                                style="background-color: {{ $category->color ?? '#2563EB' }}">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">
                                    {{ $category->name }}
                                </p>

                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Delete this category? This cannot be undone.')"
                                        class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-14 text-center">
                        <div class="mx-auto w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
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

    </div>
</x-app-layout>