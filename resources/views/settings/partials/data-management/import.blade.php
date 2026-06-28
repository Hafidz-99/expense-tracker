<div>
    <h3 class="text-sm font-bold text-slate-900">
        Import Data
    </h3>

    <p class="mt-1 text-sm text-slate-500">
        Import expenses from a CSV or Excel file.
    </p>

    <form action="#" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
        @csrf

        <div>
            <x-ui.label for="file">
                Import File
            </x-ui.label>

            <x-ui.input id="file" type="file" name="file" accept=".csv,.xlsx,.xls" />

            <x-ui.form-error field="file" />
        </div>

        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
            <p class="text-sm font-medium text-amber-800">
                Expected columns
            </p>

            <p class="text-sm text-slate-500">
                Importing expenses from CSV and Excel will be available in a future update.
            </p>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-amber-700">
                <li>Date</li>
                <li>Category</li>
                <li>Amount</li>
                <li>Note (optional)</li>
            </ul>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="button" disabled>
                Import Data
            </x-ui.button>
        </div>
    </form>
</div>
