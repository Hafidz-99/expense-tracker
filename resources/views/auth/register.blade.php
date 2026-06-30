<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
            Create account
        </h1>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Start tracking your expenses today.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Name
            </label>

            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name"
                   placeholder="Your name"
                   class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('name')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Email
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="username"
                   placeholder="you@example.com"
                   class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('email')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="new-password"
                   placeholder="Create a password"
                   class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('password')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Confirm Password
            </label>

            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   placeholder="Confirm your password"
                   class="w-full mt-2 bg-white shadow-sm rounded-xl border-slate-300 text-slate-700 placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">

            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full px-4 py-3 text-sm font-bold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
            Create account
        </button>

        <p class="text-sm text-center text-slate-500 dark:text-slate-400">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>
