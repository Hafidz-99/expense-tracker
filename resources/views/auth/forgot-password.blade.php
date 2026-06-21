<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900">
            Forgot password?
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Enter your email and we’ll send you a password reset link.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">
                Email
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   placeholder="you@example.com"
                   class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition">
            Send reset link
        </button>

        <p class="text-center text-sm text-slate-500">
            Remember your password?
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>