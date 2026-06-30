<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Expenses
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Add, filter and manage your daily spending records.
                </p>
            </div>

            <div class="flex flex-col w-full gap-3 my-2 sm:w-auto sm:flex-row">
                <div
                    class="px-4 py-2 text-sm font-semibold text-center text-blue-600 border border-blue-200 rounded-xl bg-blue-50 dark:bg-blue-500/10 dark:border-blue-500/30 dark:text-blue-300">
                    {{ now()->format('d M Y') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-4">
        @include('expenses.partials.create-form')
        @include('expenses.partials.filters')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:items-start">
            <div id="expense-list-section" class="lg:col-span-2">
                @include('expenses.partials.expense-list')
            </div>
            @include('expenses.partials.monthly-summary')
        </div>

        @include('expenses.partials.delete-modal')
        @include('expenses.partials.edit-modal')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const expenseListSection = document.getElementById('expense-list-section');

            if (!expenseListSection) {
                return;
            }

            expenseListSection.addEventListener('click', async (event) => {
                const link = event.target.closest('[data-ajax-pagination] a');

                if (!link) {
                    return;
                }

                event.preventDefault();

                try {
                    expenseListSection.classList.add('opacity-60', 'pointer-events-none');

                    const response = await fetch(link.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    if (!response.ok) {
                        window.location.href = link.href;
                        return;
                    }

                    expenseListSection.innerHTML = await response.text();
                    window.history.pushState({}, '', link.href);

                    expenseListSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                } catch (error) {
                    window.location.href = link.href;
                } finally {
                    expenseListSection.classList.remove('opacity-60', 'pointer-events-none');
                }
            });

            window.addEventListener('popstate', async () => {
                try {
                    const response = await fetch(window.location.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    if (response.ok) {
                        expenseListSection.innerHTML = await response.text();
                    }
                } catch (error) {
                    window.location.reload();
                }
            });
        });
    </script>
</x-app-layout>
