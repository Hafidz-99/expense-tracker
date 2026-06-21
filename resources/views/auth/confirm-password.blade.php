<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900">
            Confirm password
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Please confirm your password before continuing.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">
                Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="Enter your password"
                   class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition">
            Confirm
        </button>
    </form>
</x-guest-layout>