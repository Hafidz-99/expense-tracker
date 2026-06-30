<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Reports
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Review your spending activity and export expense records.
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

    <div class="space-y-6">
        @include('reports.partials.filters')

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-5 xl:items-start">
            <div class="xl:col-span-2">
                @include('reports.partials.summary-cards')
            </div>

            <div class="xl:col-span-3">
                @include('reports.partials.monthly-trend')
            </div>
        </div>

        @include('reports.partials.category-report')

        @include('reports.partials.expense-list')
    </div>

    @include('reports.partials.export-modal')
    @include('reports.partials.import-modal')
</x-app-layout>
