<div>
    <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
        Reset Data
    </h3>

    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Permanently remove selected application data from your account.
    </p>

    <div class="grid gap-4 mt-4 md:grid-cols-3">
        <div
            class="flex flex-col justify-between p-4 border rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/30">
            <div>
                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                    Reset Expenses
                </h4>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Delete all expenses while keeping categories and budgets.
                </p>
            </div>

            <x-ui.button variant="danger" type="button" class="justify-center mt-4"
                onclick="openResetModal(
                    '{{ route('settings.reset.expenses') }}',
                    'Reset Expenses',
                    'This will permanently delete all your expenses. This action cannot be undone.'
                )">
                Reset Expenses
            </x-ui.button>
        </div>

        <div
            class="flex flex-col justify-between p-4 border rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/30">
            <div>
                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                    Reset Budgets
                </h4>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Delete all budgets while keeping expenses and categories.
                </p>
            </div>

            <x-ui.button variant="danger" type="button" class="justify-center mt-4"
                onclick="openResetModal(
                    '{{ route('settings.reset.budgets') }}',
                    'Reset Budgets',
                    'This will permanently delete all your budgets. This action cannot be undone.'
                )">
                Reset Budgets
            </x-ui.button>
        </div>

        <div
            class="flex flex-col justify-between p-4 border border-red-200 rounded-xl bg-red-50 dark:border-red-500/30 dark:bg-red-500/10">
            <div>
                <h4 class="text-sm font-semibold text-red-800 dark:text-red-300">
                    Reset Everything
                </h4>
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                    Delete categories, expenses, budgets, and reset preferences while keeping your account.
                </p>
            </div>

            <x-ui.button variant="danger" type="button" class="justify-center mt-4"
                onclick="openResetModal(
                    '{{ route('settings.reset.all') }}',
                    'Reset Everything',
                    'This will permanently delete all categories, expenses, budgets and reset your preferences. This action cannot be undone.'
                )">
                Reset Everything
            </x-ui.button>
        </div>
    </div>

    @include('settings.partials.data-management.reset-modal')
</div>
