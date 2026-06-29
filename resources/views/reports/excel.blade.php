<table>
    <tr>
        <th colspan="4">Expense Report</th>
    </tr>

    <tr>
        <td colspan="4">Generated on {{ now()->format('d/m/Y h:i A') }}</td>
    </tr>

    <tr>
        <td colspan="4">Report Period: {{ $reportPeriod }}</td>
    </tr>

    <tr></tr>

    <tr>
        <th>Total Spending</th>
        <th>Transactions</th>
        <th>Average Transaction</th>
        <th>Top Category</th>
    </tr>

    <tr>
        <td>RM {{ number_format($totalSpending, 2) }}</td>
        <td>{{ $totalTransactions }}</td>
        <td>RM {{ number_format($averageTransaction, 2) }}</td>
        <td>{{ $topCategory['category']->name ?? 'No data' }}</td>
    </tr>

    <tr></tr>

    <tr>
        <th colspan="4">Category Breakdown</th>
    </tr>

    <tr>
        <th>Category</th>
        <th>Transactions</th>
        <th>Percentage</th>
        <th>Total</th>
    </tr>

    @foreach ($categoryReports as $report)
        <tr>
            <td>{{ $report['category']->name ?? 'Uncategorized' }}</td>
            <td>{{ $report['transactions'] }}</td>
            <td>{{ number_format($report['percentage'], 1) }}%</td>
            <td>RM {{ number_format($report['total'], 2) }}</td>
        </tr>
    @endforeach

    <tr></tr>

    <tr>
        <th colspan="4">Expense List</th>
    </tr>

    <tr>
        <th>Date</th>
        <th>Category</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>

    @foreach ($expenses as $expense)
        <tr>
            <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
            <td>{{ $expense->category?->name ?? 'Uncategorized' }}</td>
            <td>{{ $expense->description ?: '-' }}</td>
            <td>RM {{ number_format($expense->amount, 2) }}</td>
        </tr>
    @endforeach
</table>
