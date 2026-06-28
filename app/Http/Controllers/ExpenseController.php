<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(Request $request): View
    {
        $userId = Auth::id();

        $setting = Setting::where('user_id', $userId)->first();

        $categories = Category::where('user_id', $userId)
            ->orderBy('name')
            ->get();

        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'month' => ['nullable', 'integer', 'min:1', 'max:12'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:'.now()->year],
            'category_id' => ['nullable', 'integer'],
            'sort' => ['nullable', 'in:newest,oldest,highest,lowest'],
        ]);

        $selectedMonth = (int) ($request->month ?? now()->month);
        $selectedYear = (int) ($request->year ?? now()->year);

        $expensesQuery = Expense::with('category')
            ->where('user_id', $userId)
            ->whereMonth('expense_date', $selectedMonth)
            ->whereYear('expense_date', $selectedYear)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('description', 'like', '%'.$request->search.'%');
            })
            ->when($request->filled('category_id'), function ($query) use ($request, $userId) {
                $query->whereHas('category', function ($categoryQuery) use ($request, $userId) {
                    $categoryQuery->where('id', $request->category_id)
                        ->where('user_id', $userId);
                });
            });

        match ($request->sort) {
            'oldest' => $expensesQuery->oldest('expense_date')->oldest(),
            'highest' => $expensesQuery->orderByDesc('amount'),
            'lowest' => $expensesQuery->orderBy('amount'),
            default => $expensesQuery->latest('expense_date')->latest(),
        };

        $expenses = $expensesQuery->paginate(5)->withQueryString();

        $monthlySummary = Expense::selectRaw('category_id, SUM(amount) as total')
            ->with('category')
            ->where('user_id', $userId)
            ->whereMonth('expense_date', $selectedMonth)
            ->whereYear('expense_date', $selectedYear)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->get();

        return view('expenses.index', compact(
            'expenses',
            'categories',
            'monthlySummary',
            'selectedMonth',
            'selectedYear',
            'setting',
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $userId = Auth::id();

        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
            'expense_date' => ['required', 'date'],
        ]);

        Category::where('id', $request->category_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        Expense::create([
            'user_id' => $userId,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
        ]);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully.');
    }

    public function update(Request $request, Expense $expense): RedirectResponse
    {
        $userId = Auth::id();

        abort_if($expense->user_id !== $userId, 403);

        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
            'expense_date' => ['required', 'date'],
        ]);

        Category::where('id', $request->category_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $expense->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
        ]);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        abort_if($expense->user_id !== Auth::id(), 403);

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
