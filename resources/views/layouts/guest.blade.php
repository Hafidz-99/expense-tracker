<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>
    <meta name="description" content="Track and manage your personal expenses.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-700">

    <div class="min-h-screen flex">

        {{-- Left brand panel (hidden on mobile) --}}
        <div class="hidden lg:flex lg:w-1/2 xl:w-2/5 bg-slate-900 flex-col justify-between p-12">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-white">ExpenseTracker</span>
                </div>

                <div class="mt-16">
                    <h2 class="text-3xl font-extrabold text-white leading-tight">
                        Take control of<br>your spending.
                    </h2>
                    <p class="mt-4 text-slate-400 text-sm leading-relaxed">
                        Track every expense, organise by category, and get a clear picture of where your money goes — all in one place.
                    </p>
                </div>

                <div class="mt-12 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-400">Log expenses in seconds</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-400">Filter by month and category</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-400">Monthly spending summary at a glance</p>
                    </div>
                </div>
            </div>

            <p class="text-xs text-slate-600">
                &copy; {{ now()->year }} ExpenseTracker. All rights reserved.
            </p>
        </div>

        {{-- Right form panel --}}
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-white">
            <div class="w-full max-w-sm">

                {{-- Mobile logo --}}
                <div class="flex items-center gap-2 mb-8 lg:hidden">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <span class="text-base font-bold text-slate-800">ExpenseTracker</span>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>
