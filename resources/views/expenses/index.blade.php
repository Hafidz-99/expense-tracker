<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Expenses
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Add, filter and manage your daily spending records.
            </p>
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
