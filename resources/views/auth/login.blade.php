<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
            Welcome back
        </h1>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Sign in to continue managing your expenses.
        </p>
    </div>

    @if (session('status'))
        <div
            class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 dark:border-green-500/30 dark:bg-green-500/10 dark:text-green-300">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Email
            </label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" placeholder="you@example.com"
                class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('email')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Password
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                        Forgot?
                    </a>
                @endif
            </div>

            <input id="password" type="password" name="password" required autocomplete="current-password"
                placeholder="Enter your password"
                class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('password')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                class="text-blue-600 bg-white rounded border-slate-300 focus:ring-blue-600 dark:border-slate-600 dark:bg-slate-800 dark:focus:ring-blue-400">

            <span class="text-sm text-slate-600 dark:text-slate-400">
                Remember me
            </span>
        </label>

        <button type="submit"
            class="w-full px-4 py-3 text-sm font-bold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
            Sign in
        </button>

        <p class="text-sm text-center text-slate-500 dark:text-slate-400">
            Don't have an account?
            <a href="{{ route('register') }}"
                class="font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                Create one
            </a>
        </p>
    </form>
</x-guest-layout>
