<x-ui.modal id="reportExportModal" title="Export Report">
    <div class="space-y-3">
        <x-ui.button :href="route('reports.excel')" variant="secondary" class="justify-center w-full">
            Export Excel
        </x-ui.button>

        <x-ui.button :href="route('reports.pdf')" variant="secondary" class="justify-center w-full">
            Export PDF
        </x-ui.button>

        <x-ui.button :href="route('reports.print')" variant="secondary" class="justify-center w-full">
            Print Report
        </x-ui.button>
    </div>

    <x-slot:footer>
        <div class="flex justify-end">
            <x-ui.button type="button" variant="secondary" onclick="closeReportExportModal()">
                Close
            </x-ui.button>
        </div>
    </x-slot:footer>
</x-ui.modal>

<script>
    function openReportExportModal() {
        document.getElementById('reportExportModal').classList.remove('hidden');
    }

    function closeReportExportModal() {
        document.getElementById('reportExportModal').classList.add('hidden');
    }
</script>
