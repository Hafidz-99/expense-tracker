@php
    $mainLinks = [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'active' => 'dashboard',
        ],
        [
            'label' => 'Categories',
            'route' => 'categories.index',
            'active' => 'categories.*',
        ],
        [
            'label' => 'Expenses',
            'route' => 'expenses.index',
            'active' => 'expenses.*',
        ],
        [
            'label' => 'Budgets',
            'route' => 'budgets.index',
            'active' => 'budgets.*',
        ],
        [
            'label' => 'Reports',
            'route' => 'reports.index',
            'active' => 'reports.*',
        ],
    ];

    $accountLinks = [
        [
            'label' => 'Profile',
            'route' => 'profile.edit',
            'active' => 'profile.*',
        ],
        [
            'label' => 'Settings',
            'route' => 'settings.index',
            'active' => 'settings.*',
        ],
    ];

    $linkClass = function ($active) {
        return request()->routeIs($active)
            ? 'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-400 dark:bg-blue-950/40 dark:text-blue-400'
            : 'border-transparent text-slate-600 hover:bg-blue-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400';
    };
@endphp

{{-- Desktop Sidebar --}}
<aside
    class="fixed inset-y-0 left-0 z-50 flex-col hidden bg-white border-r lg:flex w-72 border-slate-200 dark:bg-slate-900 dark:border-slate-800">

    <div class="flex items-center h-20 px-6 bg-white border-b border-slate-200 dark:bg-slate-900 dark:border-slate-800">
        <x-application-logo :href="route('dashboard')" />
    </div>

    <nav class="flex-1 px-4 py-6">
        <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
            Main Menu
        </p>

        <div class="space-y-1">
            @foreach ($mainLinks as $link)
                <a href="{{ route($link['route']) }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition {{ $linkClass($link['active']) }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="mt-12">
            <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                Account
            </p>

            <div class="space-y-1">
                @foreach ($accountLinks as $link)
                    <a href="{{ route($link['route']) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition {{ $linkClass($link['active']) }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
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

{{-- Mobile Sidebar --}}
<div id="mobileSidebar" class="fixed inset-0 z-50 hidden transition-opacity duration-300 lg:hidden">
    <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-900/50"></div>

    <aside id="mobileSidebarPanel"
        class="fixed inset-y-0 left-0 flex flex-col transition-transform duration-300 -translate-x-full bg-white border-r w-80 max-w-[85vw] border-slate-200 dark:bg-slate-900 dark:border-slate-800">

        <div
            class="flex items-center justify-between h-20 px-6 bg-white border-b border-slate-200 dark:bg-slate-900 dark:border-slate-800">
            <x-application-logo :href="route('dashboard')" />

            <button type="button" id="closeMobileMenu"
                class="w-9 h-9 rounded-xl text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                ✕
            </button>
        </div>

        <nav class="flex-1 px-4 py-6">
            <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                Main Menu
            </p>

            <div class="space-y-1">
                @foreach ($mainLinks as $link)
                    <a href="{{ route($link['route']) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition {{ $linkClass($link['active']) }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                <p class="px-3 mb-3 text-xs font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">
                    Account
                </p>

                <div class="space-y-1">
                    @foreach ($accountLinks as $link)
                        <a href="{{ route($link['route']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl border-l-4 text-sm font-semibold transition {{ $linkClass($link['active']) }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
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
