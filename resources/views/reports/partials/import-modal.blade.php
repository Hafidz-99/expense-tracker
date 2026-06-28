<x-ui.modal id="reportImportModal" title="Import Expenses">
    <form id="reportImportForm" method="POST" action="{{ route('reports.import') }}" enctype="multipart/form-data"
        class="space-y-6">
        @csrf

        <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4">
            <div class="flex gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white">
                    ↓
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-900">
                        Upload CSV File
                    </h3>
                    <p class="mt-1 text-sm text-slate-600">
                        Import multiple expenses at once using a properly formatted CSV file.
                    </p>
                </div>
            </div>
        </div>

        <div x-data="{ fileName: '' }">
            <x-ui.label for="import_file">
                CSV File
            </x-ui.label>

            <label for="import_file"
                class="mt-2 flex cursor-pointer items-center justify-between rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4 transition hover:border-blue-400 hover:bg-blue-50">
                <div>
                    <p class="font-semibold text-slate-800" x-text="fileName || 'Browse CSV File'"></p>

                    <p class="mt-1 text-sm text-slate-500"
                        x-text="fileName ? 'Click to choose another file' : 'Click to select a CSV file'"></p>
                </div>

                <div class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white">
                    Browse
                </div>
            </label>

            <input id="import_file" type="file" name="file" accept=".csv" class="hidden" required
                @change="fileName = $event.target.files.length ? $event.target.files[0].name : ''" />

            <x-ui.form-error field="file" />

            <p class="mt-2 text-xs text-slate-500">
                Only CSV files are supported.
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">
                        Required Format
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Your CSV must include these columns:
                    </p>
                </div>

                <x-ui.button :href="route('reports.import.template')" variant="ghost" class="shrink-0">
                    Sample CSV
                </x-ui.button>
            </div>

            <div class="mt-4 overflow-hidden rounded-xl border border-slate-200 bg-white">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-100 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-4 py-3 font-semibold">date</th>
                            <th class="px-4 py-3 font-semibold">category</th>
                            <th class="px-4 py-3 font-semibold">amount</th>
                            <th class="px-4 py-3 font-semibold">note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr>
                            <td class="px-4 py-3">2026-06-28</td>
                            <td class="px-4 py-3">Food</td>
                            <td class="px-4 py-3">15.50</td>
                            <td class="px-4 py-3">Lunch</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <x-slot:footer>
        <div class="flex justify-end gap-3">
            <x-ui.button type="button" variant="secondary" onclick="closeReportImportModal()">
                Cancel
            </x-ui.button>

            <x-ui.button type="submit" form="reportImportForm">
                Import Expenses
            </x-ui.button>
        </div>
    </x-slot:footer>
</x-ui.modal>

<script>
    function openReportImportModal() {
        document.getElementById('reportImportModal').classList.remove('hidden');
    }

    function closeReportImportModal() {
        document.getElementById('reportImportModal').classList.add('hidden');
    }
</script>
