<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Reports
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    View spending summaries, category breakdowns and export reports.
                </p>
            </div>

            <div class="flex flex-col w-full gap-3 sm:w-auto sm:flex-row">
                <div
                    class="w-full px-4 py-2 text-sm font-semibold text-center text-blue-600 border border-blue-200 rounded-xl bg-blue-50 sm:w-auto">
                    {{ $selectedMonth
                        ? \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y')
                        : now()->format('F Y') }}
                </div>
            </div>
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
