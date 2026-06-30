<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
            Forgot password?
        </h1>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Enter your email and we’ll send you a password reset link.
        </p>
    </div>

    @if (session('status'))
        <div
            class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 dark:border-green-500/30 dark:bg-green-500/10 dark:text-green-300">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Email
            </label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="you@example.com"
                class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('email')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full px-4 py-3 text-sm font-bold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
            Send reset link
        </button>

        <p class="text-sm text-center text-slate-500 dark:text-slate-400">
            Remember your password?
            <a href="{{ route('login') }}"
                class="font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>
