<x-ui.modal id="deleteBudgetModal" title="Delete Budget">
    <form id="deleteBudgetForm" method="POST">
        @csrf
        @method('DELETE')

        <div class="p-4 border border-red-100 rounded-2xl bg-red-50">
            <p class="text-sm text-red-700">
                You are about to delete
                <span id="deleteBudgetName" class="font-bold"></span>.

                <br><br>

                This action cannot be undone.
            </p>
        </div>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" onclick="closeDeleteBudgetModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button variant="danger" type="submit" form="deleteBudgetForm">
                    Delete Budget
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

<script>
    function openDeleteBudgetModal(action, name) {
        deleteBudgetForm.action = action;
        deleteBudgetName.textContent = `"${name}"`;

        deleteBudgetModal.classList.remove('hidden');
        deleteBudgetModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteBudgetModal() {
        deleteBudgetModal.classList.add('hidden');
        deleteBudgetModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
