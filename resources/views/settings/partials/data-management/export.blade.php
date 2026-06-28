<div>
    <h3 class="text-sm font-bold text-slate-900">
        Export Data
    </h3>
    <p class="mt-1 text-sm text-slate-500">
        Download your expenses and reports for backup or offline use.
    </p>

    <div class="grid gap-4 mt-4 md:grid-cols-3">
        <a href="{{ route('reports.excel') }}"
            class="flex flex-col justify-between p-4 transition border rounded-xl border-slate-200 hover:border-blue-300 hover:bg-blue-50">
            <span>
                <span class="block text-sm font-semibold text-slate-800">
                    Excel Export
                </span>
                <span class="block mt-1 text-sm text-slate-500">
                    Download spreadsheet report.
                </span>
            </span>

            <span class="mt-4 text-sm font-semibold text-blue-600">
                Export Excel →
            </span>
        </a>

        <a href="{{ route('reports.pdf') }}"
            class="flex flex-col justify-between p-4 transition border rounded-xl border-slate-200 hover:border-blue-300 hover:bg-blue-50">
            <span>
                <span class="block text-sm font-semibold text-slate-800">
                    PDF Export
                </span>
                <span class="block mt-1 text-sm text-slate-500">
                    Download printable report.
                </span>
            </span>

            <span class="mt-4 text-sm font-semibold text-blue-600">
                Export PDF →
            </span>
        </a>

        <a href="{{ route('reports.index') }}"
            class="flex flex-col justify-between p-4 transition border rounded-xl border-slate-200 hover:border-blue-300 hover:bg-blue-50">
            <span>
                <span class="block text-sm font-semibold text-slate-800">
                    Reports Page
                </span>
                <span class="block mt-1 text-sm text-slate-500">
                    View detailed reports first.
                </span>
            </span>

            <span class="mt-4 text-sm font-semibold text-blue-600">
                Open Reports →
            </span>
        </a>
    </div>
</div>
