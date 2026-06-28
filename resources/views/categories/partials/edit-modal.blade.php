<x-ui.modal id="editCategoryModal" title="Edit Category" description="Update the category name and color.">
    <form id="editCategoryForm" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <x-ui.label for="editCategoryName">
                Category Name
            </x-ui.label>

            <x-ui.input id="editCategoryName" type="text" name="name" required />

            <x-ui.form-error field="name" />
        </div>

        <div>
            <x-ui.label for="editCategoryColor">
                Category Color
            </x-ui.label>

            <div class="relative mt-2">
                <div id="editSelectedColorPreview"
                    class="absolute w-4 h-4 -translate-y-1/2 border rounded-full left-3 top-1/2 border-slate-300">
                </div>

                <select id="editCategoryColor" name="color"
                    class="w-full pl-10 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    @foreach ($colors as $hex => $label)
                        <option value="{{ $hex }}">
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-ui.form-error field="color" />
        </div>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" onclick="closeEditCategoryModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button type="submit" form="editCategoryForm">
                    Save Changes
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

<script>
    const colorSelect = document.getElementById('colorSelect');
    const selectedColorPreview = document.getElementById('selectedColorPreview');

    function updateCreateColorPreview() {
        if (colorSelect && selectedColorPreview) {
            selectedColorPreview.style.backgroundColor = colorSelect.value;
        }
    }

    colorSelect?.addEventListener('change', updateCreateColorPreview);
    updateCreateColorPreview();

    const editCategoryModal = document.getElementById('editCategoryModal');
    const editCategoryForm = document.getElementById('editCategoryForm');
    const editCategoryName = document.getElementById('editCategoryName');
    const editCategoryColor = document.getElementById('editCategoryColor');
    const editSelectedColorPreview = document.getElementById('editSelectedColorPreview');

    function openEditCategoryModal(action, name, color) {
        editCategoryForm.action = action;
        editCategoryName.value = name;
        editCategoryColor.value = color;

        updateEditCategoryColorPreview();

        editCategoryModal.classList.remove('hidden');
        editCategoryModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditCategoryModal() {
        editCategoryModal.classList.add('hidden');
        editCategoryModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    function updateEditCategoryColorPreview() {
        editSelectedColorPreview.style.backgroundColor = editCategoryColor.value;
    }

    editCategoryColor?.addEventListener('change', updateEditCategoryColorPreview);

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditCategoryModal();
        }
    });
</script>
