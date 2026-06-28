<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Settings
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage your preferences, account options, and application data.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        @include('settings.partials.preferences-card')
    </div>
</x-app-layout>
