<x-ui.modal id="deleteCategoryModal" title="Delete Category">
    <form id="deleteCategoryForm" method="POST">
        @csrf
        @method('DELETE')

        <p class="text-sm text-slate-600">
            Are you sure you want to delete
            <span id="deleteCategoryName" class="font-semibold text-slate-900"></span>?
        </p>

        <p class="mt-2 text-sm text-red-600">
            This action cannot be undone.
        </p>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" onclick="closeDeleteCategoryModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button type="submit" variant="danger" form="deleteCategoryForm">
                    Delete Category
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

<script>
    const deleteCategoryModal = document.getElementById('deleteCategoryModal');
    const deleteCategoryForm = document.getElementById('deleteCategoryForm');
    const deleteCategoryName = document.getElementById('deleteCategoryName');

    function openDeleteCategoryModal(action, name) {
        deleteCategoryForm.action = action;
        deleteCategoryName.textContent = name;

        deleteCategoryModal.classList.remove('hidden');
        deleteCategoryModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteCategoryModal() {
        deleteCategoryModal.classList.add('hidden');
        deleteCategoryModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteCategoryModal();
        }
    });
</script>
