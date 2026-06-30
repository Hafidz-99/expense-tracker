<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                    Budgets
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Set and manage your monthly spending limits.
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

    <div class="space-y-6">
        @include('budgets.partials.stat-cards')
        @include('budgets.partials.create-form')
        @include('budgets.partials.filters')
        <div id="budget-list-section">
            @include('budgets.partials.budget-list')
        </div>
        @include('budgets.partials.edit-modal')
        @include('budgets.partials.delete-modal')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const budgetListSection = document.getElementById('budget-list-section');

            if (!budgetListSection) {
                return;
            }

            budgetListSection.addEventListener('click', async (event) => {
                const link = event.target.closest('[data-ajax-pagination] a');

                if (!link) {
                    return;
                }

                event.preventDefault();

                try {
                    budgetListSection.classList.add('opacity-60', 'pointer-events-none');

                    const response = await fetch(link.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    if (!response.ok) {
                        window.location.href = link.href;
                        return;
                    }

                    budgetListSection.innerHTML = await response.text();
                    window.history.pushState({}, '', link.href);

                    budgetListSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                } catch (error) {
                    window.location.href = link.href;
                } finally {
                    budgetListSection.classList.remove('opacity-60', 'pointer-events-none');
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
                        budgetListSection.innerHTML = await response.text();
                    }
                } catch (error) {
                    window.location.reload();
                }
            });
        });
    </script>
</x-app-layout>
