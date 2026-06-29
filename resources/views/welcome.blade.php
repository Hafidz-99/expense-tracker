<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-700 overflow-hidden">
    <div class="h-screen flex flex-col">

        <header class="h-16 bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <a href="/" class="space-y-2">
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">
                        Expense<span class="italic text-blue-600">Tracker</span>
                    </h1>

                    <div class="flex items-center gap-3">
                        <div class="w-8 h-px bg-blue-600"></div>

                        <p class="text-xs font-medium tracking-[0.2em] uppercase text-slate-500">
                            Personal Finance
                        </p>
                    </div>
                </a>

                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition">
                            Register
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="flex-1 overflow-hidden">
            <div class="max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8">
                <div class="h-full grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                    <section>
                        <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight">
                            Track your expenses without the clutter.
                        </h1>

                        <p class="mt-5 max-w-xl text-base sm:text-lg text-slate-600 leading-relaxed">
                            A clean personal expense tracker for recording spending, managing categories, and viewing
                            monthly summaries.
                        </p>

                        <div class="mt-8 flex flex-col sm:flex-row gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex justify-center items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="inline-flex justify-center items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition">
                                    Get Started
                                </a>

                                <a href="{{ route('login') }}"
                                    class="inline-flex justify-center items-center px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 text-sm font-bold rounded-xl border border-slate-200 transition">
                                    Sign In
                                </a>
                            @endauth
                        </div>

                        <div class="mt-8 grid grid-cols-3 gap-4 max-w-md">
                            <div>
                                <p class="text-2xl font-extrabold text-slate-900">CRUD</p>
                                <p class="text-xs text-slate-500">Expenses</p>
                            </div>

                            <div>
                                <p class="text-2xl font-extrabold text-slate-900">Auth</p>
                                <p class="text-xs text-slate-500">Login/Register</p>
                            </div>

                            <div>
                                <p class="text-2xl font-extrabold text-slate-900">MVC</p>
                                <p class="text-xs text-slate-500">Laravel Flow</p>
                            </div>
                        </div>
                    </section>

                    <section class="hidden lg:block">
                        <div class="bg-white border border-slate-200 rounded-3xl shadow-xl p-6">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Monthly Summary</p>
                                    <p class="text-xs text-slate-500">{{ now()->format('F Y') }}</p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-600">
                                    Active
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200">
                                    <p class="text-xs text-slate-500">This Month</p>
                                    <p class="mt-2 text-2xl font-extrabold text-slate-900">RM 1,250</p>
                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200">
                                    <p class="text-xs text-slate-500">Today</p>
                                    <p class="mt-2 text-2xl font-extrabold text-slate-900">RM 45</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-3">
                                <div
                                    class="flex items-center justify-between p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Food</p>
                                        <p class="text-xs text-slate-500">Lunch and groceries</p>
                                    </div>
                                    <p class="text-sm font-extrabold text-blue-600">RM 450</p>
                                </div>

                                <div
                                    class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Transport</p>
                                        <p class="text-xs text-slate-500">Fuel and e-hailing</p>
                                    </div>
                                    <p class="text-sm font-extrabold text-slate-900">RM 200</p>
                                </div>

                                <div
                                    class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Shopping</p>
                                        <p class="text-xs text-slate-500">Personal items</p>
                                    </div>
                                    <p class="text-sm font-extrabold text-slate-900">RM 300</p>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </main>

    </div>
</body>

</html>
