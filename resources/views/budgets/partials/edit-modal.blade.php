<x-ui.modal id="editBudgetModal" title="Edit Budget" description="Update the budget amount, month, and year."
    maxWidth="max-w-lg">
    <form id="editBudgetForm" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <x-ui.label for="editBudgetAmount">
                Amount (RM)
            </x-ui.label>

            <x-ui.input id="editBudgetAmount" type="number" name="amount" step="0.01" min="1" required />

            <x-ui.form-error field="amount" />
        </div>

        <div>
            <x-ui.label for="editBudgetMonth">
                Month
            </x-ui.label>

            <x-ui.select id="editBudgetMonth" name="month" required>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">
                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </x-ui.select>

            <x-ui.form-error field="month" />
        </div>

        <div>
            <x-ui.label for="editBudgetYear">
                Year
            </x-ui.label>

            <x-ui.input id="editBudgetYear" type="number" name="year" min="2020" max="2100" required />

            <x-ui.form-error field="year" />
        </div>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" onclick="closeEditBudgetModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button type="submit" form="editBudgetForm">
                    Save Changes
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

<script>
    function openEditBudgetModal(action, amount, month, year) {
        editBudgetForm.action = action;
        editBudgetAmount.value = amount;
        editBudgetMonth.value = month;
        editBudgetYear.value = year;

        editBudgetModal.classList.remove('hidden');
        editBudgetModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditBudgetModal() {
        editBudgetModal.classList.add('hidden');
        editBudgetModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
