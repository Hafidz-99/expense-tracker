@if (session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)" x-transition class="fixed z-50 right-6 top-6">
        @if (session('success'))
            <div
                class="flex items-start gap-3 px-4 py-3 bg-white border border-green-200 shadow-lg rounded-2xl dark:bg-slate-800 dark:border-green-500/30">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full bg-green-50 dark:bg-green-500/10">
                    <span class="text-sm font-bold text-green-600 dark:text-green-300">✓</span>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                        Success
                    </p>
                    <p class="mt-0.5 text-sm text-slate-600 dark:text-slate-400">
                        {{ session('success') }}
                    </p>
                </div>

                <button type="button" x-on:click="show = false"
                    class="ml-4 text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300">
                    ×
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="flex items-start gap-3 px-4 py-3 bg-white border border-red-200 shadow-lg rounded-2xl dark:bg-slate-800 dark:border-red-500/30">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full bg-red-50 dark:bg-red-500/10">
                    <span class="text-sm font-bold text-red-600 dark:text-red-300">!</span>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                        Error
                    </p>
                    <p class="mt-0.5 text-sm text-slate-600 dark:text-slate-400">
                        {{ session('error') }}
                    </p>
                </div>

                <button type="button" x-on:click="show = false"
                    class="ml-4 text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300">
                    ×
                </button>
            </div>
        @endif
    </div>
@endif
