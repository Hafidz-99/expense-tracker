<x-ui.card title="Profile Information" description="Update your name and email address.">

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <div>
            <x-ui.label for="name">
                Name
            </x-ui.label>

            <x-ui.input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                autofocus autocomplete="name" />

            <x-ui.form-error field="name" />
        </div>

        <div>
            <x-ui.label for="email">
                Email
            </x-ui.label>

            <x-ui.input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username" />

            <x-ui.form-error field="email" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="px-4 py-3 mt-3 border rounded-xl border-amber-200 bg-amber-50">
                    <p class="text-sm text-amber-700">
                        Your email address is unverified.

                        <button form="send-verification" class="font-semibold underline hover:text-amber-800">
                            Resend verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-semibold text-green-700">
                            A new verification link has been sent.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:items-center sm:justify-end">
            @if (session('status') === 'profile-updated')
                <p class="text-sm font-semibold text-green-600">
                    Saved.
                </p>
            @endif

            <x-ui.button type="submit" class="w-full sm:w-auto" loading loadingText="Saving...">
                Save Changes
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
