<x-ui.modal id="reportImportModal" title="Import Expenses">
    <form id="reportImportForm" method="POST" action="{{ route('reports.import') }}" enctype="multipart/form-data"
        class="space-y-6">
        @csrf

        <div class="p-4 border border-blue-100 rounded-2xl bg-blue-50 dark:border-blue-500/30 dark:bg-blue-500/10">
            <div class="flex gap-3">
                <div class="flex items-center justify-center w-10 h-10 text-white bg-blue-600 shrink-0 rounded-xl">
                    ↓
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                        Upload CSV File
                    </h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
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
                class="flex items-center justify-between p-4 mt-2 transition border border-dashed cursor-pointer rounded-2xl border-slate-300 bg-slate-50 hover:border-blue-400 hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/40 dark:hover:border-blue-500 dark:hover:bg-blue-500/10">
                <div>
                    <p class="font-semibold text-slate-800 dark:text-slate-100" x-text="fileName || 'Browse CSV File'">
                    </p>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"
                        x-text="fileName ? 'Click to choose another file' : 'Click to select a CSV file'"></p>
                </div>

                <div class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-xl">
                    Browse
                </div>
            </label>

            <input id="import_file" type="file" name="file" accept=".csv" class="hidden" required
                @change="fileName = $event.target.files.length ? $event.target.files[0].name : ''" />

            <x-ui.form-error field="file" />

            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                Only CSV files are supported.
            </p>
        </div>

        <div class="p-4 border rounded-2xl border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/40">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                        Required Format
                    </h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Your CSV must include these columns:
                    </p>
                </div>

                <x-ui.button :href="route('reports.import.template')" variant="ghost" class="shrink-0">
                    Sample CSV
                </x-ui.button>
            </div>

            <div
                class="mt-4 overflow-hidden bg-white border rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800">
                <table class="w-full text-sm text-left">
                    <thead
                        class="text-xs tracking-wide uppercase bg-slate-100 text-slate-500 dark:bg-slate-900/50 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3 font-semibold">date</th>
                            <th class="px-4 py-3 font-semibold">category</th>
                            <th class="px-4 py-3 font-semibold">amount</th>
                            <th class="px-4 py-3 font-semibold">note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 dark:divide-slate-700 dark:text-slate-300">
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
