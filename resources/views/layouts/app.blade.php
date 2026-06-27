<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-700">
    <div class="flex min-h-screen">

        <aside class="fixed inset-y-0 left-0 z-50 flex-col hidden bg-white border-r lg:flex w-72 border-slate-200">
            <div class="flex items-center h-20 px-6 border-b border-slate-200 bg-blue-50/40">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-600 shadow-sm rounded-2xl">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-lg font-extrabold leading-tight text-slate-900">ExpenseTracker</p>
                        <p class="text-xs font-medium text-slate-500">Personal Finance</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 px-4 py-6">
                <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400">
                    Main Menu
                </p>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('dashboard') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('categories.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Categories
                    </a>

                    <a href="{{ route('expenses.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('expenses.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Expenses
                    </a>

                    <a href="{{ route('budgets.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('budgets.*')
                            ? 'border-blue-600 bg-blue-50 text-blue-600'
                            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Budgets
                    </a>

                    <a href="{{ route('reports.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('reports.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Reports
                    </a>
                </div>

                <div class="mt-12">
                    <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400">
                        Account
                    </p>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('profile.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Profile
                    </a>
                </div>
            </nav>

            <div class="p-4 border-t border-slate-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full px-3 py-2.5 rounded-xl text-sm font-semibold text-left transition-all duration-200 text-slate-600 hover:bg-red-50 hover:text-red-600">
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 min-h-screen lg:ml-72">
            <header class="sticky top-0 z-40 h-20 border-b bg-white/90 backdrop-blur border-slate-200">
                <div class="flex items-center justify-between h-full px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center min-w-0 gap-4">
                        <button type="button" id="mobileMenuBtn"
                            class="inline-flex items-center justify-center w-10 h-10 transition lg:hidden rounded-xl text-slate-600 hover:bg-slate-100">
                            ☰
                        </button>

                        <div class="min-w-0">
                            @isset($header)
                                {!! $header !!}
                            @else
                                <h1 class="text-lg font-bold text-slate-900">Dashboard</h1>
                                <p class="mt-1 text-sm text-slate-500">
                                    Manage your expenses and monitor your spending.
                                </p>
                            @endisset
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-3 py-2 transition-all duration-200 bg-white border rounded-2xl border-slate-200 hover:bg-blue-50 hover:border-blue-100 hover:shadow-sm">
                            <div
                                class="flex items-center justify-center text-sm font-bold text-white bg-blue-600 rounded-full w-9 h-9">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="hidden min-w-0 text-left md:block">
                                <p class="text-sm font-bold leading-tight truncate text-slate-900 max-w-32">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs leading-tight truncate text-slate-500 max-w-40">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            <div id="mobileSidebar" class="fixed inset-0 z-50 hidden transition-opacity duration-300 lg:hidden">
                <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-900/50"></div>

                <aside id="mobileSidebarPanel"
                    class="fixed inset-y-0 left-0 flex flex-col transition-transform duration-300 -translate-x-full bg-white border-r w-80 max-w-[85vw] border-slate-200">
                    <div class="flex items-center justify-between h-20 px-6 border-b border-slate-200 bg-blue-50/40">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-2xl">
                                <span class="font-bold text-white">+</span>
                            </div>

                            <div>
                                <p class="text-lg font-extrabold leading-tight text-slate-900">ExpenseTracker</p>
                                <p class="text-xs font-medium text-slate-500">Personal Finance</p>
                            </div>
                        </a>

                        <button type="button" id="closeMobileMenu"
                            class="w-9 h-9 rounded-xl text-slate-500 hover:bg-slate-100">
                            ✕
                        </button>
                    </div>

                    <nav class="flex-1 px-4 py-6">
                        <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400">
                            Main Menu
                        </p>

                        <div class="space-y-1">
                            <a href="{{ route('dashboard') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('expenses.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold {{ request()->routeIs('expenses.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Expenses
                            </a>

                            <a href="{{ route('categories.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold {{ request()->routeIs('categories.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Categories
                            </a>

                            <a href="{{ route('budgets.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold {{ request()->routeIs('budgets.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Budgets
                            </a>

                            <a href="{{ route('reports.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold {{ request()->routeIs('reports.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Reports
                            </a>
                        </div>

                        <div class="mt-12">
                            <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400">
                                Account
                            </p>

                            <a href="{{ route('profile.edit') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold {{ request()->routeIs('profile.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Profile
                            </a>
                        </div>
                    </nav>

                    <div class="p-4 border-t border-slate-200">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="w-full px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-red-50 hover:text-red-600 text-left">
                                Log Out
                            </button>
                        </form>
                    </div>
                </aside>
            </div>

            <main class="flex-1 w-full px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <x-ui.toast />

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        const mobileSidebarPanel = document.getElementById("mobileSidebarPanel");

        function openSidebar() {
            mobileSidebar.classList.remove("hidden");

            requestAnimationFrame(() => {
                mobileSidebarPanel.classList.remove("-translate-x-full");
            });

            document.body.classList.add("overflow-hidden");
        }

        function closeSidebar() {
            mobileSidebarPanel.classList.add("-translate-x-full");

            setTimeout(() => {
                mobileSidebar.classList.add("hidden");
            }, 300);

            document.body.classList.remove("overflow-hidden");
        }

        mobileMenuBtn?.addEventListener("click", openSidebar);
        sidebarBackdrop?.addEventListener("click", closeSidebar);
        closeMobileMenu?.addEventListener("click", closeSidebar);
    </script>
</body>

</html>
