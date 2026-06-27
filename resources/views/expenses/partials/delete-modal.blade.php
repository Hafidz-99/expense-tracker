<x-ui.modal id="deleteExpenseModal" title="Delete Expense">
    <form id="deleteExpenseForm" method="POST">
        @csrf
        @method('DELETE')

        <p class="text-sm text-slate-600">
            Are you sure you want to delete
            <span id="deleteExpenseAmount" class="font-semibold text-slate-900"></span>
            from
            <span id="deleteExpenseCategory" class="font-semibold text-slate-900"></span>?
        </p>

        <p class="mt-2 text-sm text-red-600">
            This action cannot be undone.
        </p>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" onclick="closeDeleteExpenseModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button variant="danger" type="submit" loading loadingText="Deleting...">
                    Delete Expense
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

<script>
    function openDeleteExpenseModal(action, amount, category) {
        const modal = document.getElementById('deleteExpenseModal');
        const form = document.getElementById('deleteExpenseForm');

        form.action = action;

        document.getElementById('deleteExpenseAmount').textContent = amount;
        document.getElementById('deleteExpenseCategory').textContent = category;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteExpenseModal() {
        const modal = document.getElementById('deleteExpenseModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
