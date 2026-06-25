<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">Categories</h1>
            <p class="mt-1 text-sm text-slate-500">
                Organize your expenses using names and colors.
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
        @include('categories.partials.create-form')
        @include('categories.partials.category-list')
        @include('categories.partials.edit-modal')
        @include('categories.partials.delete-modal')
    </div>
</x-app-layout>
