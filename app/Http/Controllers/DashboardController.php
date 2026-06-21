<?php

namespace App\Http\Controllers;

use App\Models\Expense;

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

        $totalTransactions = Expense::where('user_id', $userId)->count();

        $recentExpenses = Expense::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'monthlyTotal',
            'todayTotal',
            'totalTransactions',
            'recentExpenses'
        ));
    }
}
