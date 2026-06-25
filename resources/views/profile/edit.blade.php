<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Profile
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage your account information and security settings.
            </p>
        </div>
    </x-slot>

    <div class="flex justify-center">
        <div class="w-full max-w-4xl space-y-6">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
