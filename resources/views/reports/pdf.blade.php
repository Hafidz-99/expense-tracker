<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 12px;
        }

        .header {
            margin-bottom: 24px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .muted {
            color: #64748b;
        }

        .section {
            margin-top: 24px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .cards {
            width: 100%;
            border-collapse: collapse;
        }

        .cards td {
            width: 25%;
            border: 1px solid #e2e8f0;
            padding: 12px;
            vertical-align: top;
        }

        .label {
            color: #64748b;
            font-size: 11px;
        }

        .value {
            margin-top: 6px;
            font-size: 16px;
            font-weight: bold;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.data-table th {
            text-align: left;
            color: #64748b;
            border-bottom: 1px solid #cbd5e1;
            padding: 8px 6px;
            font-size: 11px;
        }

        table.data-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 6px;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            color: #64748b;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">Expense Report</div>
        <div class="muted">
            Generated on {{ now()->format('d/m/Y h:i A') }}
        </div>
        <div class="muted">
            Report Period: {{ $reportPeriod }}
        </div>
    </div>

    <table class="cards">
        <tr>
            <td>
                <div class="label">Total Spending</div>
                <div class="value">RM {{ number_format($totalSpending, 2) }}</div>
            </td>
            <td>
                <div class="label">Transactions</div>
                <div class="value">{{ $totalTransactions }}</div>
            </td>
            <td>
                <div class="label">Average Daily</div>
                <div class="value">RM {{ number_format($averageDailySpending, 2) }}</div>
            </td>
            <td>
                <div class="label">Top Category</div>
                <div class="value">{{ $topCategory['category']->name ?? 'No data' }}</div>
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="section-title">Analytics</div>

        <table class="cards">
            <tr>
                <td>
                    <div class="label">Average Transaction</div>
                    <div class="value">RM {{ number_format($averageTransaction, 2) }}</div>
                </td>
                <td>
                    <div class="label">Largest Expense</div>
                    <div class="value">RM {{ number_format($largestExpense->amount ?? 0, 2) }}</div>
                </td>
                <td>
                    <div class="label">Most Used Category</div>
                    <div class="value">{{ $mostUsedCategory['category']->name ?? 'No data' }}</div>
                </td>
                <td>
                    <div class="label">Highest Spending Month</div>
                    <div class="value">{{ $highestSpendingMonth['month'] ?? 'No data' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Category Breakdown</div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th class="text-right">Transactions</th>
                    <th class="text-right">Average</th>
                    <th class="text-right">Percentage</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categoryReports as $report)
                    <tr>
                        <td>{{ $report['category']->name ?? 'Uncategorized' }}</td>
                        <td class="text-right">{{ $report['transactions'] }}</td>
                        <td class="text-right">RM {{ number_format($report['average'], 2) }}</td>
                        <td class="text-right">{{ number_format($report['percentage'], 1) }}%</td>
                        <td class="text-right">RM {{ number_format($report['total'], 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No category data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Expense List</div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Note</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($expenses as $expense)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
                        <td>{{ $expense->category->name ?? 'Uncategorized' }}</td>
                        <td>{{ $expense->note ?? '-' }}</td>
                        <td class="text-right">RM {{ number_format($expense->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No expenses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        Personal Expense Tracker — Generated report
    </div>
</body>

</html>
