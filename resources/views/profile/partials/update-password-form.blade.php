<x-ui.card title="Security" description="Update your password to keep your account secure.">

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700">
                Current Password
            </label>

            <input id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password"
                class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700">
                New Password
            </label>

            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700">
                Confirm Password
            </label>

            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password"
                class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            @if (session('status') === 'password-updated')
                <p class="text-sm font-semibold text-green-600">
                    Saved.
                </p>
            @endif

            <x-ui.button type="submit" loading loadingText="Updating...">
                Update Password
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
