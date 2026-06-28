<x-ui.card title="Data Management" description="Export, import, reset, and review your stored application data.">
    <div class="space-y-8">
        @include('settings.partials.data-management.storage')

        <hr class="border-slate-200">

        @include('settings.partials.data-management.export')

        <hr class="border-slate-200">

        @include('settings.partials.data-management.import')

        <hr class="border-slate-200">

        @include('settings.partials.data-management.reset')
    </div>
</x-ui.card>
