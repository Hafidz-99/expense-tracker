@php
    $theme = auth()->check() ? auth()->user()->setting?->theme ?? 'system' : 'system';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme === 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

<body class="font-sans antialiased bg-slate-50 text-slate-700 dark:bg-slate-950 dark:text-slate-200">
    <div class="flex min-h-screen">

        {{-- Desktop Sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 flex-col hidden bg-white border-r lg:flex w-72 border-slate-200 dark:bg-slate-900 dark:border-slate-800">

            {{-- Brand --}}
            <div
                class="flex items-center h-20 px-6 bg-white border-b border-slate-200 dark:bg-slate-900 dark:border-slate-800">
                <a href="{{ route('dashboard') }}" class="space-y-2">
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">
                        Expense<span class="italic text-blue-600 dark:text-blue-400">Tracker</span>
                    </h1>

                    <div class="flex items-center gap-3">
                        <div class="w-8 h-px bg-blue-600 dark:bg-blue-400"></div>

                        <p class="text-xs font-medium tracking-[0.2em] uppercase text-slate-500 dark:text-slate-400">
                            Personal Finance
                        </p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 px-4 py-6">
                <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                    Main Menu
                </p>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('dashboard')
                            ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('categories.*')
                            ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                        Categories
                    </a>

                    <a href="{{ route('expenses.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('expenses.*')
                            ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                        Expenses
                    </a>

                    <a href="{{ route('budgets.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('budgets.*')
                            ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                        Budgets
                    </a>

                    <a href="{{ route('reports.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                        {{ request()->routeIs('reports.*')
                            ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                        Reports
                    </a>
                </div>

                <div class="mt-12">
                    <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                        Account
                    </p>

                    <div class="space-y-1">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                            {{ request()->routeIs('profile.*')
                                ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                            Profile
                        </a>

                        <a href="{{ route('settings.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                            {{ request()->routeIs('settings.*')
                                ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                            Settings
                        </a>
                    </div>
                </div>
            </nav>

            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full px-3 py-2.5 rounded-xl text-sm font-semibold text-left transition-all duration-200 text-slate-600 hover:bg-red-50 hover:text-red-600 dark:text-slate-300 dark:hover:bg-red-950/40 dark:hover:text-red-400">
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 min-w-0 min-h-screen lg:ml-72">

            {{-- Topbar --}}
            <header
                class="sticky top-0 z-40 border-b bg-white/90 backdrop-blur border-slate-200 dark:bg-slate-900/90 dark:border-slate-800">
                <div class="flex items-center justify-between gap-6 px-4 py-3 sm:px-6 lg:px-8">

                    <button id="mobileMenuBtn" type="button"
                        class="inline-flex items-center justify-center w-10 h-10 transition rounded-xl lg:hidden text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">
                        ☰
                    </button>

                    <div class="flex-1 hidden min-w-0 lg:block">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center justify-center p-0 transition-all duration-200 md:justify-start md:gap-3 md:px-3 md:py-2 md:bg-white md:border md:rounded-2xl md:border-slate-200 md:hover:bg-blue-50 md:hover:border-blue-100 md:hover:shadow-sm md:dark:bg-slate-900 md:dark:border-slate-700 md:dark:hover:bg-slate-800 md:dark:hover:border-slate-600">

                        <div
                            class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-blue-600 rounded-full dark:bg-blue-500">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="hidden min-w-0 text-left md:block">
                            <p class="text-sm font-bold leading-tight truncate max-w-32 text-slate-900 dark:text-white">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs leading-tight truncate max-w-40 text-slate-500 dark:text-slate-400">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </a>
                </div>
            </header>

            @isset($header)
                <section class="px-4 py-6 lg:hidden sm:px-6">
                    {{ $header }}
                </section>
            @endisset

            {{-- Mobile Sidebar --}}
            <div id="mobileSidebar" class="fixed inset-0 z-50 hidden transition-opacity duration-300 lg:hidden">
                <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-900/50"></div>

                <aside id="mobileSidebarPanel"
                    class="fixed inset-y-0 left-0 flex flex-col transition-transform duration-300 -translate-x-full bg-white border-r w-80 max-w-[85vw] border-slate-200 dark:bg-slate-900 dark:border-slate-800">

                    <div
                        class="flex items-center justify-between h-20 px-6 bg-white border-b border-slate-200 dark:bg-slate-900 dark:border-slate-800">
                        <a href="{{ route('dashboard') }}" class="space-y-2">
                            <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">
                                Expense<span class="italic text-blue-600 dark:text-blue-400">Tracker</span>
                            </h1>

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-px bg-blue-600 dark:bg-blue-400"></div>

                                <p
                                    class="text-xs font-medium tracking-[0.2em] uppercase text-slate-500 dark:text-slate-400">
                                    Personal Finance
                                </p>
                            </div>
                        </a>

                        <button type="button" id="closeMobileMenu"
                            class="w-9 h-9 rounded-xl text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                            ✕
                        </button>
                    </div>

                    <nav class="flex-1 px-4 py-6">
                        <p
                            class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                            Main Menu
                        </p>

                        <div class="space-y-1">
                            <a href="{{ route('dashboard') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                {{ request()->routeIs('dashboard')
                                    ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                    : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('categories.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                {{ request()->routeIs('categories.*')
                                    ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                    : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                Categories
                            </a>

                            <a href="{{ route('expenses.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                {{ request()->routeIs('expenses.*')
                                    ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                    : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                Expenses
                            </a>

                            <a href="{{ route('budgets.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                {{ request()->routeIs('budgets.*')
                                    ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                    : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                Budgets
                            </a>

                            <a href="{{ route('reports.index') }}"
                                class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                {{ request()->routeIs('reports.*')
                                    ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                    : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                Reports
                            </a>
                        </div>

                        <div class="mt-12">
                            <p
                                class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                                Account
                            </p>

                            <div class="space-y-1">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                    {{ request()->routeIs('profile.*')
                                        ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                        : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                    Profile
                                </a>

                                <a href="{{ route('settings.index') }}"
                                    class="block px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                                    {{ request()->routeIs('settings.*')
                                        ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
                                        : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400' }}">
                                    Settings
                                </a>
                            </div>
                        </div>
                    </nav>

                    <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="w-full px-3 py-2.5 rounded-xl text-sm font-semibold text-left transition-all duration-200 text-slate-600 hover:bg-red-50 hover:text-red-600 dark:text-slate-300 dark:hover:bg-red-950/40 dark:hover:text-red-400">
                                Log Out
                            </button>
                        </form>
                    </div>
                </aside>
            </div>

            <main class="flex-1 w-full min-w-0 px-4 pb-8 overflow-x-hidden sm:px-6 lg:px-8 lg:pt-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <x-ui.toast />

    <script>
        const mobileMenuBtn = document.getElementById("mobileMenuBtn");
        const mobileSidebar = document.getElementById("mobileSidebar");
        const sidebarBackdrop = document.getElementById("sidebarBackdrop");
        const closeMobileMenu = document.getElementById("closeMobileMenu");
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
