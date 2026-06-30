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

<body class="font-sans antialiased bg-slate-50 text-slate-700 dark:bg-slate-950 dark:text-slate-300">
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-8">

        <x-application-logo href="/" class="mb-8" />

        <div
            class="w-full max-w-md p-8 bg-white border shadow-sm border-slate-200 rounded-2xl dark:bg-slate-800 dark:border-slate-700">
            {{ $slot }}
        </div>

    </div>
</body>

</html>
