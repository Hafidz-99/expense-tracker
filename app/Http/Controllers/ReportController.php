<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseReportExport;
use App\Models\Category;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        return view('reports.index', $this->getReportData($request));
    }

    public function print(Request $request): View
    {
        return view('reports.print', $this->getReportData($request));
    }

    public function pdf(Request $request): Response
    {
        $data = $this->getReportData($request);

        $pdf = Pdf::loadView('reports.pdf', $data)
            ->setPaper('a4', 'portrait');

        $filename = 'expense-report-'.now()->format('Ymd-His').'.pdf';

        return $pdf->download($filename);
    }

    public function excel(Request $request): BinaryFileResponse
    {
        $data = $this->getReportData($request);

        return Excel::download(
            new ExpenseReportExport($data),
            'expense-report-'.now()->format('Ymd-His').'.xlsx'
        );
    }

    private function getReportData(Request $request): array
    {
        $request->validate([
            'month' => ['nullable', 'date_format:Y-m'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'search' => ['nullable', 'string', 'max:255'],
            'sort' => ['nullable', 'in:latest,oldest,highest,lowest'],
        ]);

        $selectedMonth = $request->input('month', now()->format('Y-m'));
        $selectedCategory = $request->input('category_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');
        $sort = $request->input('sort', 'latest');

        $selectedDate = Carbon::createFromFormat('Y-m', $selectedMonth);

        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        $query = Expense::with('category')
            ->where('user_id', Auth::id());

        if ($startDate && $endDate) {
            $query->whereBetween('expense_date', [$startDate, $endDate]);
        } else {
            $query->whereYear('expense_date', $selectedDate->year)
                ->whereMonth('expense_date', $selectedDate->month);
        }

        if ($selectedCategory) {
            $query->where('category_id', $selectedCategory);
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('description', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $query = match ($sort) {
            'oldest' => $query->orderBy('expense_date'),
            'highest' => $query->orderByDesc('amount'),
            'lowest' => $query->orderBy('amount'),
            default => $query->orderByDesc('expense_date'),
        };

        $expenses = $query->get();

        $totalSpending = $expenses->sum('amount');
        $totalTransactions = $expenses->count();

        $daysCount = $startDate && $endDate
            ? Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1
            : $selectedDate->daysInMonth;

        $averageDailySpending = $daysCount > 0
            ? $totalSpending / $daysCount
            : 0;

        $categoryReports = $expenses
            ->groupBy('category_id')
            ->map(function ($items) use ($totalSpending) {
                $category = $items->first()->category;
                $categoryTotal = $items->sum('amount');
                $transactions = $items->count();

                return [
                    'category' => $category,
                    'total' => $categoryTotal,
                    'transactions' => $transactions,
                    'average' => $transactions > 0 ? $categoryTotal / $transactions : 0,
                    'percentage' => $totalSpending > 0
                        ? ($categoryTotal / $totalSpending) * 100
                        : 0,
                ];
            })
            ->sortByDesc('total');

        $topCategory = $categoryReports->first();

        $averageTransaction = $totalTransactions > 0
            ? $totalSpending / $totalTransactions
            : 0;

        $largestExpense = $expenses
            ->sortByDesc('amount')
            ->first();

        $mostUsedCategory = $categoryReports
            ->sortByDesc('transactions')
            ->first();

        $previousMonth = $selectedDate->copy()->subMonth();

        $previousMonthTotal = Expense::where('user_id', Auth::id())
            ->whereYear('expense_date', $previousMonth->year)
            ->whereMonth('expense_date', $previousMonth->month)
            ->sum('amount');

        $monthlyDifference = $totalSpending - $previousMonthTotal;

        $monthlyDifferencePercentage = $previousMonthTotal > 0
            ? ($monthlyDifference / $previousMonthTotal) * 100
            : 0;

        $year = $selectedDate->year;

        $monthlyTrend = Expense::where('user_id', Auth::id())
            ->whereYear('expense_date', $year)
            ->selectRaw('MONTH(expense_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) use ($year) {
                return [
                    'month' => Carbon::create($year, $item->month, 1)->format('F'),
                    'total' => $item->total,
                ];
            });

        $highestSpendingMonth = $monthlyTrend
            ->sortByDesc('total')
            ->first();

        $reportPeriod = $startDate && $endDate
            ? Carbon::parse($startDate)->format('d/m/Y').' - '.Carbon::parse($endDate)->format('d/m/Y')
            : $selectedDate->format('F Y');

        return [
            'selectedMonth' => $selectedMonth,
            'selectedCategory' => $selectedCategory,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'search' => $search,
            'sort' => $sort,
            'categories' => $categories,
            'expenses' => $expenses,
            'totalSpending' => $totalSpending,
            'totalTransactions' => $totalTransactions,
            'averageDailySpending' => $averageDailySpending,
            'categoryReports' => $categoryReports,
            'topCategory' => $topCategory,
            'averageTransaction' => $averageTransaction,
            'largestExpense' => $largestExpense,
            'mostUsedCategory' => $mostUsedCategory,
            'previousMonthTotal' => $previousMonthTotal,
            'monthlyDifference' => $monthlyDifference,
            'monthlyDifferencePercentage' => $monthlyDifferencePercentage,
            'monthlyTrend' => $monthlyTrend,
            'highestSpendingMonth' => $highestSpendingMonth,
            'reportPeriod' => $reportPeriod,
        ];
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $user = $request->user();

        $rows = array_map(
            'str_getcsv',
            file($request->file('file')->getRealPath())
        );

        if (count($rows) < 2) {
            return back()->withErrors([
                'file' => 'The uploaded CSV file is empty.',
            ]);
        }

        $header = array_map('trim', array_map('strtolower', $rows[0]));

        $required = ['date', 'category', 'amount', 'note'];

        foreach ($required as $column) {
            if (! in_array($column, $header)) {
                return back()->withErrors([
                    'file' => "Missing required column: {$column}.",
                ]);
            }
        }

        $indexes = array_flip($header);

        DB::transaction(function () use ($rows, $indexes, $user) {

            foreach (array_slice($rows, 1) as $row) {

                if (count($row) === 0 || empty(array_filter($row))) {
                    continue;
                }

                Validator::make([
                    'date' => $row[$indexes['date']] ?? null,
                    'category' => $row[$indexes['category']] ?? null,
                    'amount' => $row[$indexes['amount']] ?? null,
                ], [
                    'date' => ['required', 'date'],
                    'category' => ['required', 'string', 'max:255'],
                    'amount' => ['required', 'numeric', 'min:0'],
                ])->validate();

                $category = Category::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'name' => trim($row[$indexes['category']]),
                    ],
                    [
                        'color' => '#2563EB',
                    ]
                );

                Expense::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'amount' => $row[$indexes['amount']],
                    'expense_date' => $row[$indexes['date']],
                    'description' => $row[$indexes['note']] ?? null,
                ]);
            }
        });

        return back()->with(
            'success',
            'Expenses imported successfully.'
        );
    }

    public function downloadImportTemplate()
    {
        $filename = 'expense-import-template.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $rows = [
            ['date', 'category', 'amount', 'note'],
            ['2026-06-28', 'Food', '15.50', 'Lunch'],
            ['2026-06-28', 'Transport', '8.20', 'Bus fare'],
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');

            foreach ($rows as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
