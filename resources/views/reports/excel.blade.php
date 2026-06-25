<table>
    <tr>
        <th colspan="5">Expense Report</th>
    </tr>
    <tr>
        <td colspan="5">Generated on {{ now()->format('d/m/Y h:i A') }}</td>
    </tr>
    <tr>
        <td colspan="5">Report Period: {{ $reportPeriod }}</td>
    </tr>

    <tr></tr>

    <tr>
        <th>Total Spending</th>
        <th>Transactions</th>
        <th>Average Daily Spending</th>
        <th>Top Category</th>
        <th>Highest Spending Month</th>
    </tr>
    <tr>
        <td>RM {{ number_format($totalSpending, 2) }}</td>
        <td>{{ $totalTransactions }}</td>
        <td>RM {{ number_format($averageDailySpending, 2) }}</td>
        <td>{{ $topCategory['category']->name ?? 'No data' }}</td>
        <td>{{ $highestSpendingMonth['month'] ?? 'No data' }}</td>
    </tr>

    <tr></tr>

    <tr>
        <th colspan="5">Category Breakdown</th>
    </tr>
    <tr>
        <th>Category</th>
        <th>Transactions</th>
        <th>Average</th>
        <th>Percentage</th>
        <th>Total</th>
    </tr>

    @foreach ($categoryReports as $report)
        <tr>
            <td>{{ $report['category']->name ?? 'Uncategorized' }}</td>
            <td>{{ $report['transactions'] }}</td>
            <td>RM {{ number_format($report['average'], 2) }}</td>
            <td>{{ number_format($report['percentage'], 1) }}%</td>
            <td>RM {{ number_format($report['total'], 2) }}</td>
        </tr>
    @endforeach

    <tr></tr>

    <tr>
        <th colspan="5">Expense List</th>
    </tr>
    <tr>
        <th>Date</th>
        <th>Category</th>
        <th>Note</th>
        <th>Amount</th>
        <th></th>
    </tr>

    @foreach ($expenses as $expense)
        <tr>
            <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
            <td>{{ $expense->category->name ?? 'Uncategorized' }}</td>
            <td>{{ $expense->note ?? '-' }}</td>
            <td>RM {{ number_format($expense->amount, 2) }}</td>
            <td></td>
        </tr>
    @endforeach
</table>
