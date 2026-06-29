<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Report</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
</head>

<body class="bg-white text-slate-900">
    <div class="max-w-5xl p-8 mx-auto">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Expense Report</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Generated on {{ now()->format('d/m/Y h:i A') }}
                </p>
                <p class="mt-1 text-sm text-slate-500">
                    Report Period: {{ $reportPeriod }}
                </p>
            </div>

            <button onclick="window.print()"
                class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 no-print rounded-xl hover:bg-blue-700">
                Print Report
            </button>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-8">
            <div class="p-4 border rounded-xl border-slate-200">
                <p class="text-sm text-slate-500">Total Spending</p>
                <p class="mt-1 text-xl font-bold">
                    RM {{ number_format($totalSpending, 2) }}
                </p>
            </div>

            <div class="p-4 border rounded-xl border-slate-200">
                <p class="text-sm text-slate-500">Transactions</p>
                <p class="mt-1 text-xl font-bold">
                    {{ $totalTransactions }}
                </p>
            </div>

            <div class="p-4 border rounded-xl border-slate-200">
                <p class="text-sm text-slate-500">
                    Average Transaction
                </p>

                <p class="mt-1 text-xl font-bold">
                    RM {{ number_format($averageTransaction, 2) }}
                </p>
            </div>

            <div class="p-4 border rounded-xl border-slate-200">
                <p class="text-sm text-slate-500">Top Category</p>
                <p class="mt-1 text-xl font-bold">
                    {{ $topCategory['category']->name ?? 'No data' }}
                </p>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-bold">Category Breakdown</h2>

            <table class="w-full mt-4 border-collapse">
                <thead>
                    <tr class="text-sm text-left border-b text-slate-500">
                        <th class="py-3">Category</th>
                        <th class="py-3 text-right">Transactions</th>
                        <th class="py-3 text-right">Percentage</th>
                        <th class="py-3 text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categoryReports as $report)
                        <tr class="text-sm border-b">
                            <td class="py-3">
                                {{ $report['category']->name ?? 'Uncategorized' }}
                            </td>
                            <td class="py-3 text-right">
                                {{ $report['transactions'] }}
                            </td>
                            <td class="py-3 text-right">
                                {{ number_format($report['percentage'], 1) }}%
                            </td>
                            <td class="py-3 font-semibold text-right">
                                RM {{ number_format($report['total'], 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-500">
                                No category data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-bold">Expense List</h2>

            <table class="w-full mt-4 border-collapse">
                <thead>
                    <tr class="text-sm text-left border-b text-slate-500">
                        <th class="py-3">Date</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Note</th>
                        <th class="py-3 text-right">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($expenses as $expense)
                        <tr class="text-sm border-b">
                            <td class="py-3">
                                {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                            </td>
                            <td class="py-3">
                                {{ $expense->category->name ?? 'Uncategorized' }}
                            </td>
                            <td class="py-3">
                                {{ $expense->note ?? '-' }}
                            </td>
                            <td class="py-3 font-semibold text-right">
                                RM {{ number_format($expense->amount, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-500">
                                No expenses found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
