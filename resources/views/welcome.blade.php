@php
    $theme = auth()->check() ? auth()->user()->setting?->theme ?? 'system' : 'system';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme === 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <script>
        (function() {
            const theme = @json($theme);
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            function applyTheme() {
                const shouldUseDark = theme === 'dark' || (theme === 'system' && mediaQuery.matches);

                document.documentElement.classList.toggle('dark', shouldUseDark);
            }

            applyTheme();

            mediaQuery.addEventListener('change', applyTheme);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-hidden font-sans antialiased bg-slate-50 text-slate-700 dark:bg-slate-950 dark:text-slate-300">
    <div class="flex flex-col h-screen">

        {{-- Header --}}
        <header class="h-20 bg-white border-b border-slate-200 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between h-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <x-application-logo href="/" />

                <nav class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 text-sm font-bold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-semibold transition text-slate-600 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-bold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">
                            Register
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        {{-- Main --}}
        <main class="flex items-center flex-1 overflow-hidden">
            <div
                class="grid items-center w-full h-full grid-cols-1 gap-10 px-4 mx-auto max-w-7xl sm:px-6 lg:grid-cols-2 lg:px-8">

                {{-- Left content --}}
                <section class="max-w-xl">
                    <p class="text-sm font-bold tracking-wide text-blue-600 uppercase dark:text-blue-400">
                        Simple spending tracker
                    </p>

                    <h2
                        class="mt-4 text-4xl font-extrabold leading-tight tracking-tight text-slate-900 dark:text-slate-100 sm:text-5xl">
                        Keep your daily expenses in one place.
                    </h2>

                    <p class="mt-5 text-base leading-relaxed text-slate-600 dark:text-slate-400">
                        ExpenseTracker helps you record spending, organize categories, set monthly budgets,
                        and review your reports without making the process complicated.
                    </p>

                    <div class="flex flex-col gap-3 mt-8 sm:flex-row">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">
                                Open Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">
                                Create Account
                            </a>

                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold transition bg-white border text-slate-700 rounded-xl border-slate-200 hover:bg-slate-50 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                                Sign In
                            </a>
                        @endauth
                    </div>

                    <div class="grid max-w-lg grid-cols-3 gap-4 mt-10">
                        <div>
                            <p class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                Budget
                            </p>
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                Track monthly limits
                            </p>
                        </div>

                        <div>
                            <p class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                Reports
                            </p>
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                Review spending
                            </p>
                        </div>

                        <div>
                            <p class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                Export
                            </p>
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                PDF and Excel
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Right preview --}}
                <section class="hidden lg:block">
                    <div
                        class="p-6 bg-white border shadow-sm rounded-3xl border-slate-200 dark:bg-slate-900 dark:border-slate-800">
                        <div
                            class="flex items-center justify-between pb-5 border-b border-slate-200 dark:border-slate-800">
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                    Dashboard
                                </p>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                    {{ now()->format('F Y') }} overview
                                </p>
                            </div>

                            <span
                                class="px-3 py-1 text-xs font-bold text-blue-600 rounded-full bg-blue-50 dark:bg-blue-500/10 dark:text-blue-300">
                                Sample preview
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div
                                class="p-4 border rounded-2xl border-slate-200 bg-slate-50 dark:bg-slate-800/60 dark:border-slate-700">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                    Total Expenses
                                </p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                    RM 1,250
                                </p>
                            </div>

                            <div
                                class="p-4 border rounded-2xl border-slate-200 bg-slate-50 dark:bg-slate-800/60 dark:border-slate-700">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                    Categories
                                </p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                    6
                                </p>
                            </div>

                            <div
                                class="p-4 border rounded-2xl border-slate-200 bg-slate-50 dark:bg-slate-800/60 dark:border-slate-700">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                    Monthly Budget
                                </p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                    RM 2,000
                                </p>
                            </div>

                            <div
                                class="p-4 border rounded-2xl border-slate-200 bg-slate-50 dark:bg-slate-800/60 dark:border-slate-700">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                    Remaining
                                </p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                                    RM 750
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    Budget usage
                                </p>

                                <p class="text-sm font-bold text-blue-600 dark:text-blue-300">
                                    62%
                                </p>
                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                                <div class="h-full bg-blue-600 rounded-full w-[62%]"></div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                    Recent Expenses
                                </p>

                                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                                    Latest activity
                                </p>
                            </div>

                            <div class="space-y-3">
                                <div
                                    class="flex items-center justify-between p-4 border rounded-2xl border-slate-200 dark:border-slate-700">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                            Lunch
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            Food • Today
                                        </p>
                                    </div>

                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                        RM 18.50
                                    </p>
                                </div>

                                <div
                                    class="flex items-center justify-between p-4 border rounded-2xl border-slate-200 dark:border-slate-700">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                            Fuel
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            Transport • Yesterday
                                        </p>
                                    </div>

                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                        RM 60.00
                                    </p>
                                </div>

                                <div
                                    class="flex items-center justify-between p-4 border rounded-2xl border-slate-200 dark:border-slate-700">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                            Groceries
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            Food • Yesterday
                                        </p>
                                    </div>

                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                        RM 95.20
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </main>

    </div>
</body>

</html>
