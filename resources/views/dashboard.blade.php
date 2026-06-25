<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Dashboard
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                View your spending overview and recent activity.
            </p>
        </div>
    </x-slot>

    <div class="space-y-8">
        @include('dashboard.partials.stat-cards')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            @include('dashboard.partials.recent-expenses')

            @include('dashboard.partials.category-breakdown')
        </div>
    </div>
</x-app-layout>
