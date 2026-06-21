<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $categories = Category::where('user_id', $userId)
            ->orderBy('name')
            ->get();

        $request->validate([
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:2000|max:' . now()->year,
            'category_id' => 'nullable|integer',
        ]);

        $selectedMonth = (int) ($request->month ?? now()->month);
        $selectedYear = (int) ($request->year ?? now()->year);

        $expenses = Expense::with('category')
            ->where('user_id', $userId)
            ->whereMonth('expense_date', $selectedMonth)
            ->whereYear('expense_date', $selectedYear)
            ->when($request->category_id, function ($query) use ($request, $userId) {
                $query->whereHas('category', function ($categoryQuery) use ($request, $userId) {
                    $categoryQuery->where('id', $request->category_id)
                        ->where('user_id', $userId);
                });
            })
            ->latest('expense_date')
            ->latest()
            ->get();

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
            'selectedYear'
        ));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'expense_date' => 'required|date',
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

    public function edit(Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $userId = auth()->id();

        abort_if($expense->user_id !== $userId, 403);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'expense_date' => 'required|date',
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

    public function destroy(Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}