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
                <a href="/" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                        </svg>
                    </div>

                    <span class="text-lg font-extrabold text-slate-900">
                        ExpenseTracker
                    </span>
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
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                            Laravel Portfolio Project
                        </span>

                        <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight">
                            Track your expenses without the clutter.
                        </h1>

                        <p class="mt-5 max-w-xl text-base sm:text-lg text-slate-600 leading-relaxed">
                            A clean personal expense tracker for recording spending, managing categories, and viewing monthly summaries.
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
                                <div class="flex items-center justify-between p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Food</p>
                                        <p class="text-xs text-slate-500">Lunch and groceries</p>
                                    </div>
                                    <p class="text-sm font-extrabold text-blue-600">RM 450</p>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Transport</p>
                                        <p class="text-xs text-slate-500">Fuel and e-hailing</p>
                                    </div>
                                    <p class="text-sm font-extrabold text-slate-900">RM 200</p>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-200">
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