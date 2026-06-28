<x-ui.card>
    <div>
        <h2 class="text-base font-bold text-slate-900">
            Preferences
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Customize how the application looks and behaves.
        </p>
    </div>

    <div class="grid gap-4 mt-6 md:grid-cols-2">
        <div class="p-4 border rounded-xl border-slate-200">
            <p class="text-sm font-semibold text-slate-700">Theme</p>
            <p class="mt-1 text-sm text-slate-500">{{ ucfirst($setting->theme) }}</p>
        </div>

        <div class="p-4 border rounded-xl border-slate-200">
            <p class="text-sm font-semibold text-slate-700">Currency</p>
            <p class="mt-1 text-sm text-slate-500">{{ $setting->currency }}</p>
        </div>

        <div class="p-4 border rounded-xl border-slate-200">
            <p class="text-sm font-semibold text-slate-700">Date Format</p>
            <p class="mt-1 text-sm text-slate-500">{{ $setting->date_format }}</p>
        </div>

        <div class="p-4 border rounded-xl border-slate-200">
            <p class="text-sm font-semibold text-slate-700">Timezone</p>
            <p class="mt-1 text-sm text-slate-500">{{ $setting->timezone }}</p>
        </div>
    </div>
</x-ui.card>
