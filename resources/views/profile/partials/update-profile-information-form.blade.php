<x-ui.card title="Profile Information" description="Update your name and email address.">

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700">
                Name
            </label>

            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                autofocus autocomplete="name"
                class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

            @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">
                Email
            </label>

            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username"
                class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

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

        <div class="flex items-center justify-end gap-3 pt-2">
            @if (session('status') === 'profile-updated')
                <p class="text-sm font-semibold text-green-600">
                    Saved.
                </p>
            @endif

            <x-ui.button type="submit" loading loadingText="Saving...">
                Save Changes
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
