<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Expenses
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Add, filter and manage your daily spending records.
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

    <div class="space-y-4">
        @include('expenses.partials.create-form')
        @include('expenses.partials.filters')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:items-start">
            @include('expenses.partials.expense-list')
            @include('expenses.partials.monthly-summary')
        </div>

        @include('expenses.partials.delete-modal')
        @include('expenses.partials.edit-modal')
    </div>
</x-app-layout>
