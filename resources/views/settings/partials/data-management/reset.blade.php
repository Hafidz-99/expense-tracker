<div>
    <h3 class="text-sm font-bold text-slate-900">
        Reset Data
    </h3>

    <p class="mt-1 text-sm text-slate-500">
        Permanently remove selected application data from your account.
    </p>

    <div class="grid gap-4 mt-4 md:grid-cols-3">
        <div class="flex flex-col justify-between p-4 border rounded-xl border-slate-200">
            <div>
                <h4 class="text-sm font-semibold text-slate-800">
                    Reset Expenses
                </h4>
                <p class="mt-1 text-sm text-slate-500">
                    Delete all expenses while keeping categories and budgets.
                </p>
            </div>

            <x-ui.button type="button" variant="danger" class="justify-center mt-4" disabled>
                Reset Expenses
            </x-ui.button>
        </div>

        <div class="flex flex-col justify-between p-4 border rounded-xl border-slate-200">
            <div>
                <h4 class="text-sm font-semibold text-slate-800">
                    Reset Budgets
                </h4>
                <p class="mt-1 text-sm text-slate-500">
                    Delete all budgets while keeping expenses and categories.
                </p>
            </div>

            <x-ui.button type="button" variant="danger" class="justify-center mt-4" disabled>
                Reset Budgets
            </x-ui.button>
        </div>

        <div class="flex flex-col justify-between p-4 border border-red-200 rounded-xl bg-red-50">
            <div>
                <h4 class="text-sm font-semibold text-red-800">
                    Reset Everything
                </h4>
                <p class="mt-1 text-sm text-red-600">
                    Delete categories, expenses, budgets, and settings while keeping your account.
                </p>
            </div>

            <x-ui.button type="button" variant="danger" class="justify-center mt-4" disabled>
                Reset Everything
            </x-ui.button>
        </div>
    </div>

    <p class="mt-3 text-xs text-slate-500">
        Reset actions are disabled for now and will be completed with confirmation modals and backend protection.
    </p>
</div>
