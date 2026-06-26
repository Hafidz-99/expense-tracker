<div id="deleteBudgetModal" class="fixed inset-0 z-50 hidden">
    <div onclick="closeDeleteBudgetModal()" class="fixed inset-0 bg-slate-900/50"></div>

    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white border shadow-xl rounded-2xl border-slate-200">
            <div class="px-6 py-5 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-900">Delete Budget</h2>

                <p class="mt-1 text-sm text-slate-500">
                    Are you sure you want to delete this budget?
                </p>
            </div>

            <div class="p-6">
                <div class="p-4 border border-red-100 rounded-2xl bg-red-50">
                    <p class="text-sm text-red-700">
                        You are about to delete
                        <span id="deleteBudgetName" class="font-bold"></span>.
                        This action cannot be undone.
                    </p>
                </div>

                <form id="deleteBudgetForm" method="POST" class="mt-6">
                    @csrf
                    @method('DELETE')

                    <div class="flex justify-end gap-3">
                        <x-ui.button variant="secondary" type="button" onclick="closeDeleteBudgetModal()">
                            Cancel
                        </x-ui.button>

                        <x-ui.button variant="danger" type="submit" loading loadingText="Deleting...">
                            Delete Budget
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteBudgetModal = document.getElementById('deleteBudgetModal');
    const deleteBudgetForm = document.getElementById('deleteBudgetForm');
    const deleteBudgetName = document.getElementById('deleteBudgetName');

    function openDeleteBudgetModal(action, name) {
        deleteBudgetForm.action = action;
        deleteBudgetName.textContent = `"${name}"`;

        deleteBudgetModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteBudgetModal() {
        deleteBudgetModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteBudgetModal();
        }
    });
</script>
