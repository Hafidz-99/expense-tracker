<x-ui.card title="Add Category" description="Create a category with a name and color.">

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
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
                        class="absolute w-5 h-5 -translate-y-1/2 border rounded-full left-3 top-1/2 border-slate-300"
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
            <x-ui.button type="submit" loading loadingText="Saving...">
                Add Category
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
