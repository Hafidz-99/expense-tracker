<section
    class="overflow-hidden bg-white border border-red-200 shadow-sm rounded-2xl dark:bg-slate-800 dark:border-red-500/30">
    <div class="px-6 py-4 border-b border-red-100 bg-red-50 dark:border-red-500/30 dark:bg-red-500/10">
        <h2 class="text-base font-bold text-red-700 dark:text-red-300">
            Danger Zone
        </h2>
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">
            Permanently delete your account and all related data.
        </p>
    </div>

    <div class="p-6">
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Once your account is deleted, all categories, expenses, and dashboard history will be permanently removed.
            This action cannot be undone.
        </p>

        <div class="mt-5">
            <x-ui.button variant="danger" type="button" class="w-full sm:w-auto" onclick="openDeleteAccountModal()">
                Delete Account
            </x-ui.button>
        </div>
    </div>
</section>

<x-ui.modal id="deleteAccountModal" title="Delete Account"
    description="Confirm your password before permanently deleting your account." maxWidth="max-w-lg">
    <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-5">
        @csrf
        @method('DELETE')

        <div class="p-4 border border-red-200 rounded-xl bg-red-50 dark:border-red-500/30 dark:bg-red-500/10">
            <div class="flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mt-0.5 h-5 w-5 flex-shrink-0 text-red-600 dark:text-red-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.5 20h15a2 2 0 001.71-3.14l-7.5-13a2 2 0 00-3.42 0z" />
                </svg>

                <div>
                    <h3 class="font-semibold text-red-700 dark:text-red-300">
                        This action is permanent
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-red-700 dark:text-red-300">
                        Deleting your account will permanently remove:

                        <span class="block mt-2">
                            • Profile information
                        </span>

                        <span class="block">
                            • Categories
                        </span>

                        <span class="block">
                            • Budgets
                        </span>

                        <span class="block">
                            • Expenses
                        </span>

                        <span class="block">
                            • Reports and history
                        </span>

                        <span class="block mt-3 font-medium">
                            This action cannot be undone.
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div>
            <x-ui.label for="password">
                Password
            </x-ui.label>

            <x-ui.input id="password" type="password" name="password" placeholder="Enter your password" />

            <x-ui.form-error field="userDeletion.password" />
        </div>

        <x-slot:footer>
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-ui.button variant="secondary" type="button" class="w-full sm:w-auto"
                    onclick="closeDeleteAccountModal()">
                    Cancel
                </x-ui.button>

                <x-ui.button variant="danger" type="submit" class="w-full sm:w-auto" loading loadingText="Deleting...">
                    Delete Account
                </x-ui.button>
            </div>
        </x-slot:footer>
    </form>
</x-ui.modal>

<script>
    const deleteAccountModal = document.getElementById('deleteAccountModal');
    const deleteAccountForm = deleteAccountModal.querySelector('form');

    function openDeleteAccountModal() {
        deleteAccountModal.classList.remove('hidden');
        deleteAccountModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteAccountModal() {
        deleteAccountModal.classList.add('hidden');
        deleteAccountModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        deleteAccountForm.reset();
    }
</script>
