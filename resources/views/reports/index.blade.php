<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Reports
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Review your spending activity and export expense records.
            </p>
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
