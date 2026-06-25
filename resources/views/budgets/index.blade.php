<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">Budgets</h1>
            <p class="mt-1 text-sm text-slate-500">
                Set and manage your monthly spending limits.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        @include('budgets.partials.stat-cards')
        @include('budgets.partials.create-form')
        @include('budgets.partials.budget-list')
        @include('budgets.partials.edit-modal')
        @include('budgets.partials.delete-modal')
    </div>
</x-app-layout>
