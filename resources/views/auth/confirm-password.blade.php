<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
            Confirm password
        </h1>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Please confirm your password before continuing.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="Enter your password"
                   class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('password')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full px-4 py-3 text-sm font-bold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
            Confirm
        </button>
    </form>
</x-guest-layout>
