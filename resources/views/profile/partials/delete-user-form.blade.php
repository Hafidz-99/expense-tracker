<section class="overflow-hidden bg-white border border-red-200 shadow-sm rounded-2xl">
    <div class="px-6 py-4 border-b border-red-100 bg-red-50">
        <h2 class="text-base font-bold text-red-700">
            Danger Zone
        </h2>
        <p class="mt-1 text-sm text-red-600">
            Permanently delete your account and all related data.
        </p>
    </div>

    <div class="p-6">
        <p class="text-sm text-slate-600">
            Once your account is deleted, all categories, expenses, and dashboard history will be permanently removed.
            This action cannot be undone.
        </p>

        <div class="mt-5">
            <button type="button" onclick="openDeleteAccountModal()"
                class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                Delete Account
            </button>
        </div>
    </div>
</section>

<div id="deleteAccountModal" class="fixed inset-0 z-50 hidden">
    <div onclick="closeDeleteAccountModal()" class="fixed inset-0 bg-slate-900/50"></div>

    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white border shadow-xl rounded-2xl border-slate-200">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="px-6 py-5 border-b border-slate-200">
                    <h2 class="text-lg font-bold text-slate-900">
                        Delete Account
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Enter your password to confirm account deletion.
                    </p>
                </div>

                <div class="p-6 space-y-5">
                    <div class="px-4 py-3 border border-red-100 rounded-2xl bg-red-50">
                        <p class="text-sm text-red-700">
                            This will permanently delete your account and all related data.
                        </p>
                    </div>

                    <div>
                        <label for="delete_account_password" class="block text-sm font-semibold text-slate-700">
                            Password
                        </label>

                        <input id="delete_account_password" name="password" type="password"
                            placeholder="Enter your password"
                            class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-red-500 focus:ring-red-500">

                        @error('password', 'userDeletion')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeDeleteAccountModal()"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold">
                            Delete Account
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const deleteAccountModal = document.getElementById('deleteAccountModal');

    function openDeleteAccountModal() {
        deleteAccountModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteAccountModal() {
        deleteAccountModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteAccountModal();
        }
    });
</script>
