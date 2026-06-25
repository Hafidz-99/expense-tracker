<div id="editBudgetModal" class="fixed inset-0 z-50 hidden">
    <div onclick="closeEditBudgetModal()" class="fixed inset-0 bg-slate-900/50"></div>

    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="w-full max-w-lg bg-white border shadow-xl rounded-2xl border-slate-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Edit Budget</h2>
                    <p class="text-sm text-slate-500">Update the budget amount, month, and year.</p>
                </div>

                <button type="button" onclick="closeEditBudgetModal()" class="text-slate-400 hover:text-slate-600">
                    ✕
                </button>
            </div>

            <form id="editBudgetForm" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Amount (RM)</label>
                    <input id="editBudgetAmount" type="number" name="amount" step="0.01" min="1"
                        class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Month</label>
                    <select id="editBudgetMonth" name="month"
                        class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">
                                {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Year</label>
                    <input id="editBudgetYear" type="number" name="year" min="2020" max="2100"
                        class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditBudgetModal()"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Cancel
                    </button>

                    <button type="submit"
                        class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editBudgetModal = document.getElementById('editBudgetModal');
    const editBudgetForm = document.getElementById('editBudgetForm');
    const editBudgetAmount = document.getElementById('editBudgetAmount');
    const editBudgetMonth = document.getElementById('editBudgetMonth');
    const editBudgetYear = document.getElementById('editBudgetYear');

    function openEditBudgetModal(action, amount, month, year) {
        editBudgetForm.action = action;
        editBudgetAmount.value = amount;
        editBudgetMonth.value = month;
        editBudgetYear.value = year;

        editBudgetModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditBudgetModal() {
        editBudgetModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditBudgetModal();
        }
    });
</script>
