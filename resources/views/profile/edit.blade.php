<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Profile
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Manage your account information and security settings.
                </p>
            </div>
            <div class="flex flex-col w-full gap-3 my-2 sm:w-auto sm:flex-row">
                <div
                    class="px-4 py-2 text-sm font-semibold text-center text-blue-600 border border-blue-200 rounded-xl bg-blue-50 dark:bg-blue-500/10 dark:border-blue-500/30 dark:text-blue-300">
                    {{ now()->format('d M Y') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="flex justify-center">
        <div class="w-full max-w-4xl space-y-5 sm:space-y-6">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
