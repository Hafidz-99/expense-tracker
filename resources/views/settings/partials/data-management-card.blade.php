<x-ui.card title="Data Management" description="Export, import, reset, and review your stored application data.">
    <div class="space-y-8">
        @include('settings.partials.data-management.storage')
        <div class="h-px bg-slate-200"></div>
        @include('settings.partials.data-management.reset')
    </div>
</x-ui.card>
