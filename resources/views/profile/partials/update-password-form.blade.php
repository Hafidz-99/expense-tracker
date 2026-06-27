<x-ui.card title="Security" description="Update your password to keep your account secure.">

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <x-ui.label for="update_password_current_password">
                Current Password
            </x-ui.label>

            <x-ui.input id="update_password_current_password" type="password" name="current_password"
                autocomplete="current-password" />

            <x-ui.form-error field="current_password" />
        </div>

        <div>
            <x-ui.label for="update_password_password">
                New Password
            </x-ui.label>

            <x-ui.input id="update_password_password" type="password" name="password" autocomplete="new-password" />

            <x-ui.form-error field="password" />
        </div>

        <div>
            <x-ui.label for="update_password_password_confirmation">
                Confirm Password
            </x-ui.label>

            <x-ui.input id="update_password_password_confirmation" type="password" name="password_confirmation"
                autocomplete="new-password" />

            <x-ui.form-error field="password_confirmation" />
        </div>

        <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:items-center sm:justify-end">
            @if (session('status') === 'password-updated')
                <p class="text-sm font-semibold text-green-600">
                    Saved.
                </p>
            @endif

            <x-ui.button type="submit" class="w-full sm:w-auto" loading loadingText="Updating...">
                Update Password
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
