<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();

        $setting = Setting::where('user_id', $userId)->first();

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
            ->take($setting?->recent_expenses_count ?? 5)
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
            'setting',
        ));
    }

    public function updatePreferences(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recent_expenses_count' => ['required', 'integer', 'min:3', 'max:10'],
        ]);

        $validated['show_budget_progress'] = $request->boolean('show_budget_progress');
        $validated['show_category_breakdown'] = $request->boolean('show_category_breakdown');
        $validated['show_recent_expenses'] = $request->boolean('show_recent_expenses');

        $request->user()
            ->setting()
            ->update($validated);

        return back()->with('success', 'Dashboard preferences updated successfully.');
    }
}
