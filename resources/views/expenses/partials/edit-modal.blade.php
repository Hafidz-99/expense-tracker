<x-ui.modal id="editExpenseModal" title="Edit Expense" maxWidth="max-w-lg">
    <form id="editExpenseForm" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <x-ui.label for="editExpenseCategory">
                Category
            </x-ui.label>

            <x-ui.select id="editExpenseCategory" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-ui.select>

            <x-ui.form-error field="category_id" />
        </div>

        <div>
            <x-ui.label for="editExpenseAmount">
                Amount (RM)
            </x-ui.label>

            <x-ui.input id="editExpenseAmount" type="number" name="amount" step="0.01" min="0.01" required />

            <x-ui.form-error field="amount" />
        </div>

        <div>
            <x-ui.label for="editExpenseDescription">
                Description
            </x-ui.label>

            <x-ui.input id="editExpenseDescription" type="text" name="description" placeholder="Optional note..." />

            <x-ui.form-error field="description" />
        </div>

        <div>
            <x-ui.label for="editExpenseDate">
                Date
            </x-ui.label>

            <x-ui.input id="editExpenseDate" type="date" name="expense_date" required />

            <x-ui.form-error field="expense_date" />
        </div>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" onclick="closeEditExpenseModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button type="submit" form="editExpenseForm">
                    Save Changes
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

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
        editExpenseModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditExpenseModal() {
        editExpenseModal.classList.add('hidden');
        editExpenseModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditExpenseModal();
        }
    });
</script>
