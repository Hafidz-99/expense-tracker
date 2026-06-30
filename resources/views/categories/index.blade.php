<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Categories
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Organize your expenses using names and colors.
                </p>
            </div>
            <div class="flex flex-col w-full gap-3 my-2 sm:w-auto sm:flex-row">
                <div
                    class="px-4 py-2 text-sm font-semibold text-center text-blue-600 border border-blue-200 rounded-xl bg-blue-50 dark:bg-blue-500/10 dark:border-blue-500/30 dark:text-blue-300">
                    {{ now()->format('d M Y') }}
                </div>
            </div>
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
        @include('categories.partials.filters')
        @include('categories.partials.category-list')
        @include('categories.partials.edit-modal')
        @include('categories.partials.delete-modal')
    </div>
</x-app-layout>
