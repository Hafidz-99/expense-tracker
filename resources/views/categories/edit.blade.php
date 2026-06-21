<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-lg font-bold text-slate-800">Edit Category</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl space-y-6">

        <div>
            <h2 class="text-2xl font-extrabold text-slate-800">Update Category</h2>
            <p class="mt-1 text-sm text-slate-500">Edit the details of your spending category.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="text-sm font-bold text-slate-700">Category Details</h3>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-semibold uppercase tracking-widest text-slate-400">
                            Name
                        </label>
                        <input id="name" type="text" name="name"
                               value="{{ old('name', $category->name) }}"
                               placeholder="e.g. Food, Transport"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-colors">
                        @error('name')
                            <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="color" class="block text-xs font-semibold uppercase tracking-widest text-slate-400">
                            Color
                            <span class="normal-case tracking-normal font-normal text-slate-300 ml-1">(optional)</span>
                        </label>
                        <input id="color" type="text" name="color"
                               value="{{ old('color', $category->color) }}"
                               placeholder="e.g. blue, red-500"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-colors">
                        @error('color')
                            <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="icon" class="block text-xs font-semibold uppercase tracking-widest text-slate-400">
                            Icon
                            <span class="normal-case tracking-normal font-normal text-slate-300 ml-1">(optional)</span>
                        </label>
                        <input id="icon" type="text" name="icon"
                               value="{{ old('icon', $category->icon) }}"
                               placeholder="e.g. food, car, shopping"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-colors">
                        @error('icon')
                            <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2 border-t border-slate-100">
                        <a href="{{ route('categories.index') }}"
                           class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>