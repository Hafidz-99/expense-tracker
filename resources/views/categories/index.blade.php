<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Categories
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Organize your expenses using simple colors.
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
            <div class="px-4 py-3 text-sm font-semibold text-green-700 border border-green-200 rounded-2xl bg-green-50">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="px-4 py-3 text-sm font-semibold text-red-700 border border-red-200 rounded-2xl bg-red-50">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
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

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Category Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Food"
                            class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                        @error('name')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Color
                        </label>

                        <div class="relative mt-2">
                            <div id="selectedColorPreview"
                                class="absolute w-4 h-4 -translate-y-1/2 border rounded-full left-3 top-1/2 border-slate-300"
                                style="background-color: {{ old('color', '#2563EB') }}">
                            </div>

                            <select name="color" id="colorSelect"
                                class="w-full pl-10 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                                @foreach ($colors as $hex => $label)
                                    <option value="{{ $hex }}" @selected(old('color', '#2563EB') === $hex)>
                                        {{ $label }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        @error('color')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-5">
                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                        Add Category
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
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
                    <div class="px-6 text-center py-14">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto text-blue-600 rounded-2xl bg-blue-50">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const colorSelect = document.getElementById('colorSelect');
            const preview = document.getElementById('selectedColorPreview');

            function updateColor() {
                preview.style.backgroundColor = colorSelect.value;
            }

            updateColor();

            colorSelect.addEventListener('change', updateColor);

        });
    </script>
</x-app-layout>
