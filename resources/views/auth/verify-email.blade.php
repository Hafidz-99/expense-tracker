<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
            Verify your email
        </h1>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Before continuing, please verify your email address using the link we sent you.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div
            class="px-4 py-3 mb-5 text-sm font-medium text-green-700 border border-green-200 rounded-xl bg-green-50 dark:border-green-500/30 dark:bg-green-500/10 dark:text-green-300">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit"
                class="w-full px-4 py-3 text-sm font-bold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
                Resend verification email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="w-full px-4 py-3 text-sm font-bold transition bg-white border hover:bg-slate-50 text-slate-700 rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">
                Log out
            </button>
        </form>
    </div>
</x-guest-layout>
