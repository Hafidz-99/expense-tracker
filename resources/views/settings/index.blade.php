<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Settings
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Manage your preferences, account options, and application data.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex justify-center">
        <div class="w-full max-w-4xl space-y-5 sm:space-y-6">
            @include('settings.partials.preferences-card')
            @include('settings.partials.data-management-card')
        </div>
    </div>
</x-app-layout>
