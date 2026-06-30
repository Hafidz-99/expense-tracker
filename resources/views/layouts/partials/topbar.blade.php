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
                <p class="text-sm font-bold leading-tight truncate max-w-32 text-slate-900 dark:text-slate-100">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs leading-tight truncate max-w-40 text-slate-500 dark:text-slate-400">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </a>
    </div>
</header>
