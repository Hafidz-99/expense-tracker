<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900">
            Reset password
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Create a new password for your account.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">
                Email
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   required
                   autofocus
                   autocomplete="username"
                   class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">
                New Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="new-password"
                   placeholder="Create new password"
                   class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">
                Confirm Password
            </label>

            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   placeholder="Confirm new password"
                   class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition">
            Reset password
        </button>
    </form>
</x-guest-layout>