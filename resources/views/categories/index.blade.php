<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-900">
            Categories
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto space-y-6 max-w-7xl">

            @if (session('success'))
                <div class="px-4 py-3 text-green-700 border border-green-500 rounded-lg bg-green-50">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 bg-white border border-slate-200 rounded-xl">
                <h3 class="mb-4 font-bold text-slate-900">Add Category</h3>

                <form method="POST" action="{{ route('categories.store') }}" class="flex gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Category name" class="flex-1 rounded-lg border-slate-300">
                    <button type="submit" class="px-6 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Add
                    </button>
                </form>
            </div>

            <div class="p-6 bg-white border border-slate-200 rounded-xl">
                <h3 class="mb-4 font-bold text-slate-900">Category List</h3>

                <div class="space-y-3">
                    @forelse($categories as $category)
                        <div class="flex items-center justify-between p-4 border rounded-lg border-slate-200">
                            <strong class="font-semibold text-slate-900">{{ $category->name }}</strong>

                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-slate-500">No categories found.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>