<div>
    <h3 class="text-sm font-bold text-slate-900">
        Storage Information
    </h3>
    <p class="mt-1 text-sm text-slate-500">
        Overview of your saved records in this application.
    </p>

    <div class="grid gap-4 mt-4 sm:grid-cols-3">
        <div class="p-4 border rounded-xl border-slate-200 bg-slate-50">
            <p class="text-sm font-medium text-slate-500">
                Categories
            </p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ $storageStats['categories'] }}
            </p>
        </div>

        <div class="p-4 border rounded-xl border-slate-200 bg-slate-50">
            <p class="text-sm font-medium text-slate-500">
                Expenses
            </p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ $storageStats['expenses'] }}
            </p>
        </div>

        <div class="p-4 border rounded-xl border-slate-200 bg-slate-50">
            <p class="text-sm font-medium text-slate-500">
                Budgets
            </p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ $storageStats['budgets'] }}
            </p>
        </div>
    </div>
</div>
