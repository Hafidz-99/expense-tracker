<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Dashboard
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Overview of your spending, budget, and latest activity.
                </p>
            </div>

            <div class="flex flex-col w-full gap-3 my-2 sm:w-auto sm:flex-row">
                <x-ui.button variant="secondary" type="button" onclick="openDashboardPreferencesModal()">
                    Customize
                </x-ui.button>

                <div
                    class="px-4 py-2 text-sm font-semibold text-center text-blue-600 border border-blue-200 rounded-xl bg-blue-50 dark:bg-blue-500/10 dark:border-blue-500/30 dark:text-blue-300">
                    {{ now()->format('d M Y') }}
                </div>

                <x-ui.button href="{{ route('expenses.index') }}" class="w-full sm:w-auto">
                    Add Expense
                </x-ui.button>
            </div>

        </div>
    </x-slot>

    <div class="space-y-6">
        @include('dashboard.widgets.statistics')

        @php
            $showBudgetProgress = $setting?->show_budget_progress ?? true;
            $showCategoryBreakdown = $setting?->show_category_breakdown ?? true;
        @endphp

        @if ($showBudgetProgress || $showCategoryBreakdown)
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                @if ($showBudgetProgress && $showCategoryBreakdown)
                    <div class="lg:col-span-2">
                        @include('dashboard.widgets.budget-progress')
                    </div>

                    <div>
                        @include('dashboard.widgets.category-breakdown')
                    </div>
                @elseif ($showBudgetProgress)
                    <div class="lg:col-span-3">
                        @include('dashboard.widgets.budget-progress')
                    </div>
                @elseif ($showCategoryBreakdown)
                    <div class="lg:col-span-3">
                        @include('dashboard.widgets.category-breakdown')
                    </div>
                @endif
            </div>
        @endif

        @if ($setting?->show_recent_expenses ?? true)
            @include('dashboard.widgets.recent-expenses')
        @endif
    </div>

    @include('dashboard.modals.view-options')
</x-app-layout>
