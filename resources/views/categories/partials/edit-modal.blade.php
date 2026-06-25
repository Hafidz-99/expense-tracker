<div id="editCategoryModal" class="fixed inset-0 z-50 hidden">
    <div onclick="closeEditCategoryModal()" class="fixed inset-0 bg-slate-900/50"></div>

    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="w-full max-w-lg bg-white border shadow-xl rounded-2xl border-slate-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Edit Category
                    </h2>
                    <p class="text-sm text-slate-500">
                        Update the category name and color.
                    </p>
                </div>

                <button type="button" onclick="closeEditCategoryModal()" class="text-slate-400 hover:text-slate-600">
                    ✕
                </button>
            </div>

            <form id="editCategoryForm" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700">
                        Category Name
                    </label>

                    <input id="editCategoryName" type="text" name="name"
                        class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">
                        Color
                    </label>

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
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditCategoryModal()"
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
        document.body.classList.add('overflow-hidden');
    }

    function closeEditCategoryModal() {
        editCategoryModal.classList.add('hidden');
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
