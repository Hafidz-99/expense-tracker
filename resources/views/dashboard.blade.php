<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Dashboard
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Overview of your spending, budget, and latest activity.
                </p>
            </div>

            <div class="flex flex-col w-full gap-3 sm:w-auto sm:flex-row">
                <div
                    class="px-4 py-2 text-sm font-semibold text-center text-blue-600 border border-blue-200 rounded-xl bg-blue-50">
                    {{ now()->format('d M Y') }}
                </div>

                <x-ui.button href="{{ route('expenses.index') }}" class="w-full sm:w-auto">
                    Add Expense
                </x-ui.button>
            </div>

        </div>
    </x-slot>

    <div class="space-y-6">
        @include('dashboard.partials.stat-cards')

        <div class="grid items-stretch grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="flex xl:col-span-2">
                @include('dashboard.partials.budget-progress')
            </div>

            <div class="flex">
                @include('dashboard.partials.category-breakdown')
            </div>
        </div>

        @include('dashboard.partials.recent-expenses')
    </div>
</x-app-layout>
