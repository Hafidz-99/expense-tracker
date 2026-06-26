<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Reports
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                View spending summaries, category breakdowns and export reports.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        @include('reports.partials.filters')
        @include('reports.partials.summary-cards')
        @include('reports.partials.analytics-cards')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:items-start">
            @include('reports.partials.report-insight')
            @include('reports.partials.monthly-trend')
        </div>

        @include('reports.partials.category-report')
        @include('reports.partials.expense-list')
    </div>
</x-app-layout>
