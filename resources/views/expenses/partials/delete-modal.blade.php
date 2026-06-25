<div id="deleteExpenseModal" class="fixed inset-0 z-50 hidden">
    <div onclick="closeDeleteExpenseModal()" class="fixed inset-0 bg-slate-900/50"></div>

    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white border shadow-xl rounded-2xl border-slate-200">
            <div class="px-6 py-5 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-900">
                    Delete Expense
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Are you sure you want to delete this expense?
                </p>
            </div>

            <div class="p-6">
                <div class="p-4 border border-red-100 rounded-2xl bg-red-50">
                    <p class="text-sm text-red-700">
                        You are about to delete
                        <span id="deleteExpenseAmount" class="font-bold"></span>
                        from
                        <span id="deleteExpenseCategory" class="font-bold"></span>.
                        This action cannot be undone.
                    </p>
                </div>

                <form id="deleteExpenseForm" method="POST" class="mt-6">
                    @csrf
                    @method('DELETE')

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeDeleteExpenseModal()"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold">
                            Delete Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteExpenseModal = document.getElementById('deleteExpenseModal');
    const deleteExpenseForm = document.getElementById('deleteExpenseForm');
    const deleteExpenseAmount = document.getElementById('deleteExpenseAmount');
    const deleteExpenseCategory = document.getElementById('deleteExpenseCategory');

    function openDeleteExpenseModal(action, amount, category) {
        deleteExpenseForm.action = action;
        deleteExpenseAmount.textContent = amount;
        deleteExpenseCategory.textContent = category;

        deleteExpenseModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteExpenseModal() {
        deleteExpenseModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteExpenseModal();
        }
    });
</script>
