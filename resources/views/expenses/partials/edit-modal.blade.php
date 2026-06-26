<div id="editExpenseModal" class="fixed inset-0 z-50 hidden">
    <div onclick="closeEditExpenseModal()" class="fixed inset-0 bg-slate-900/50"></div>

    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="w-full max-w-lg overflow-hidden bg-white border shadow-xl rounded-2xl border-slate-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Edit Expense
                    </h2>
                    <p class="text-sm text-slate-500">
                        Update the expense details.
                    </p>
                </div>

                <button type="button" onclick="closeEditExpenseModal()" class="text-slate-400 hover:text-slate-600">
                    ✕
                </button>
            </div>
            <div class="p-6">
                <form id="editExpenseForm" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Category
                        </label>

                        <select id="editExpenseCategory" name="category_id"
                            class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Amount
                        </label>

                        <input id="editExpenseAmount" type="number" step="0.01" name="amount"
                            class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Description
                        </label>

                        <input id="editExpenseDescription" type="text" name="description"
                            class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Date
                        </label>

                        <input id="editExpenseDate" type="date" name="expense_date"
                            class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <x-ui.button variant="secondary" type="button" onclick="closeEditExpenseModal()">
                            Cancel
                        </x-ui.button>

                        <x-ui.button type="submit" loading loadingText="Updating...">
                            Save Changes
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const editExpenseModal = document.getElementById('editExpenseModal');
    const editExpenseForm = document.getElementById('editExpenseForm');
    const editExpenseCategory = document.getElementById('editExpenseCategory');
    const editExpenseAmount = document.getElementById('editExpenseAmount');
    const editExpenseDescription = document.getElementById('editExpenseDescription');
    const editExpenseDate = document.getElementById('editExpenseDate');

    function openEditExpenseModal(action, categoryId, amount, description, date) {
        editExpenseForm.action = action;
        editExpenseCategory.value = categoryId;
        editExpenseAmount.value = amount;
        editExpenseDescription.value = description;
        editExpenseDate.value = date;

        editExpenseModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditExpenseModal() {
        editExpenseModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditExpenseModal();
        }
    });
</script>
