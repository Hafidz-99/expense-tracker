<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $monthlyTotal = Expense::where('user_id', $userId)
            ->whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');

        $todayTotal = Expense::where('user_id', $userId)
            ->whereDate('expense_date', today())
            ->sum('amount');

        $totalTransactions = Expense::where('user_id', $userId)
            ->count();

        $topCategory = Expense::select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->where('user_id', $userId)
            ->whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->first();

        $categoryBreakdown = Expense::select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->where('user_id', $userId)
            ->whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->limit(4)
            ->get();

        $recentExpenses = Expense::with('category')
            ->where('user_id', $userId)
            ->latest('expense_date')
            ->latest()
            ->take(5)
            ->get();

        $currentMonth = now()->month;
        $currentYear = now()->year;

        $currentBudget = Budget::where('user_id', $userId)
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();

        $budgetAmount = $currentBudget?->amount ?? 0;

        $remainingBudget = $budgetAmount - $monthlyTotal;

        $budgetUsedPercentage = $budgetAmount > 0
            ? min(($monthlyTotal / $budgetAmount) * 100, 100)
            : 0;

        $budgetMessage = 'No budget set for this month.';
        $budgetStatus = 'none';

        if ($currentBudget) {
            if ($monthlyTotal > $budgetAmount) {
                $overAmount = $monthlyTotal - $budgetAmount;
                $budgetMessage = 'You are over budget by RM '.number_format($overAmount, 2).'.';
                $budgetStatus = 'danger';
            } elseif ($budgetUsedPercentage >= 80) {
                $budgetMessage = 'You have used '.number_format($budgetUsedPercentage, 0).'% of your monthly budget.';
                $budgetStatus = 'warning';
            } else {
                $budgetMessage = 'You are on track. RM '.number_format($remainingBudget, 2).' remaining.';
                $budgetStatus = 'success';
            }
        }

        return view('dashboard', compact(
            'monthlyTotal',
            'todayTotal',
            'totalTransactions',
            'topCategory',
            'categoryBreakdown',
            'recentExpenses',
            'currentBudget',
            'budgetAmount',
            'remainingBudget',
            'budgetUsedPercentage',
            'budgetMessage',
            'budgetStatus',
        ));
    }
}
