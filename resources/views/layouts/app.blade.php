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
        @include('layouts.partials.sidebar')

        <div class="flex flex-col flex-1 min-w-0 min-h-screen lg:ml-72">
            @include('layouts.partials.topbar')

            @isset($header)
                <section class="px-4 py-6 lg:hidden sm:px-6">
                    {{ $header }}
                </section>
            @endisset

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
