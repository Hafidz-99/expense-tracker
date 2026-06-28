<x-ui.modal id="resetDataModal" title="Confirm Reset">
    <form id="resetDataForm" method="POST">
        @csrf
        @method('DELETE')

        <p id="resetDataMessage" class="text-sm text-slate-600"></p>
    </form>

    <x-slot:footer>
        <div class="flex justify-end gap-3">
            <x-ui.button variant="secondary" type="button" onclick="closeResetModal()">
                Cancel
            </x-ui.button>

            <x-ui.button variant="danger" type="submit" form="resetDataForm">
                Confirm Reset
            </x-ui.button>
        </div>
    </x-slot:footer>
</x-ui.modal>

<script>
    function openResetModal(action, title, message) {
        document.getElementById('resetDataForm').action = action;
        document.getElementById('resetDataMessage').textContent = message;

        const modal = document.getElementById('resetDataModal');
        const titleElement = modal.querySelector('h2');

        if (titleElement) {
            titleElement.textContent = title;
        }

        modal.classList.remove('hidden');
    }

    function closeResetModal() {
        document.getElementById('resetDataModal').classList.add('hidden');
    }
</script>
