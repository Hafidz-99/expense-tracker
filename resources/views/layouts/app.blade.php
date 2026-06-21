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
    <div class="min-h-screen flex">

        <aside class="hidden lg:flex fixed inset-y-0 left-0 z-50 w-72 flex-col bg-white border-r border-slate-200">
            <div class="h-20 flex items-center px-6 border-b border-slate-200 bg-blue-50/40">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-blue-600 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-lg font-extrabold text-slate-900 leading-tight">ExpenseTracker</p>
                        <p class="text-xs font-medium text-slate-500">Personal Finance</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 px-4 py-6">
                <p class="px-3 mb-3 text-xs font-bold uppercase tracking-widest text-slate-400">
                    Main Menu
                </p>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('dashboard') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('expenses.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('expenses.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Expenses
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition
                       {{ request()->routeIs('categories.*') ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                        Categories
                    </a>
                </div>

                <div class="mt-12">
                    <p class="px-3 mb-3 text-xs font-bold uppercase tracking-widest text-slate-400">
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
                            class="w-full px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-red-50 hover:text-red-600 transition text-left">
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 lg:ml-72 min-h-screen flex flex-col">
            <header class="sticky top-0 z-40 h-20 bg-white/90 backdrop-blur border-b border-slate-200">
                <div class="h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <div class="flex items-center gap-4 min-w-0">
                        <button type="button"
                                id="mobileMenuBtn"
                                class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 hover:bg-slate-100 transition">
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
                        <button type="button"
                                id="openExpenseModal"
                                class="hidden sm:inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                            + Add Expense
                        </button>

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 hover:bg-blue-50 hover:border-blue-100 transition">
                            <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-sm font-bold text-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="hidden md:block text-left min-w-0">
                                <p class="text-sm font-bold text-slate-900 leading-tight truncate max-w-32">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-slate-500 leading-tight truncate max-w-40">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            <div id="mobileSidebar" class="lg:hidden fixed inset-0 z-50 hidden">
                <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-900/50"></div>

                <aside class="fixed inset-y-0 left-0 w-72 bg-white border-r border-slate-200 flex flex-col">
                    <div class="h-20 flex items-center justify-between px-6 border-b border-slate-200 bg-blue-50/40">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-blue-600 flex items-center justify-center">
                                <span class="text-white font-bold">+</span>
                            </div>

                            <div>
                                <p class="text-lg font-extrabold text-slate-900 leading-tight">ExpenseTracker</p>
                                <p class="text-xs font-medium text-slate-500">Personal Finance</p>
                            </div>
                        </a>

                        <button type="button" id="closeMobileMenu" class="w-9 h-9 rounded-xl text-slate-500 hover:bg-slate-100">
                            ✕
                        </button>
                    </div>

                    <nav class="flex-1 px-4 py-6">
                        <p class="px-3 mb-3 text-xs font-bold uppercase tracking-widest text-slate-400">
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
                        </div>

                        <div class="mt-12">
                            <p class="px-3 mb-3 text-xs font-bold uppercase tracking-widest text-slate-400">
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

            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8 w-full">
    {{ $slot }}
</main>
        </div>
    </div>

    <div id="expenseModal" class="fixed inset-0 z-50 hidden">
        <div id="expenseModalBackdrop" class="fixed inset-0 bg-slate-900/50"></div>

        <div class="fixed inset-0 flex items-center justify-center px-4">
            <div class="w-full max-w-lg bg-white rounded-2xl border border-slate-200 shadow-xl">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Add Expense</h2>
                        <p class="text-sm text-slate-500">Record a new transaction.</p>
                    </div>

                    <button type="button" id="closeExpenseModal" class="text-slate-400 hover:text-slate-600">
                        ✕
                    </button>
                </div>

                <form method="POST" action="{{ route('expenses.store') }}" class="p-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Category</label>
                        <select name="category_id" required class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600">
                            <option value="">Select category</option>
                            @foreach ($layoutCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Amount</label>
                        <input type="number" step="0.01" name="amount" required placeholder="0.00"
                               class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Description</label>
                        <input type="text" name="description" placeholder="What was this for?"
                               class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Date</label>
                        <input type="date" name="expense_date" required value="{{ now()->format('Y-m-d') }}"
                               class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600">
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" id="cancelExpenseModal"
                                class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Cancel
                        </button>

                        <button type="submit"
                                class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                            Save Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        mobileMenuBtn?.addEventListener('click', () => mobileSidebar.classList.remove('hidden'));
        sidebarBackdrop?.addEventListener('click', () => mobileSidebar.classList.add('hidden'));
        closeMobileMenu?.addEventListener('click', () => mobileSidebar.classList.add('hidden'));

        const expenseModal = document.getElementById('expenseModal');
        const openExpenseModal = document.getElementById('openExpenseModal');
        const closeExpenseModal = document.getElementById('closeExpenseModal');
        const cancelExpenseModal = document.getElementById('cancelExpenseModal');
        const expenseModalBackdrop = document.getElementById('expenseModalBackdrop');

        function openModal() {
            expenseModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            expenseModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        openExpenseModal?.addEventListener('click', openModal);
        closeExpenseModal?.addEventListener('click', closeModal);
        cancelExpenseModal?.addEventListener('click', closeModal);
        expenseModalBackdrop?.addEventListener('click', closeModal);
    </script>
</body>
</html>