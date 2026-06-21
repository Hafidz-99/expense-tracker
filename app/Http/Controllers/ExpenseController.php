<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('user_id', auth()->id())->get();

        $expenses = Expense::with('category')
            ->where('user_id', auth()->id())
            ->when($request->month, function ($query) use ($request) {
                $query->whereMonth('expense_date', date('m', strtotime($request->month)))
                    ->whereYear('expense_date', date('Y', strtotime($request->month)));
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->latest()
            ->get();

        $monthlySummary = Expense::selectRaw('category_id, SUM(amount) as total')
            ->with('category')
            ->where('user_id', auth()->id())
            ->when($request->month, function ($query) use ($request) {
                $query->whereMonth('expense_date', date('m', strtotime($request->month)))
                    ->whereYear('expense_date', date('Y', strtotime($request->month)));
            })
            ->groupBy('category_id')
            ->get();

        return view('expenses.index', compact(
            'expenses',
            'categories',
            'monthlySummary'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'expense_date' => 'required|date',
        ]);

        Expense::create([
            'user_id' => auth()->id(),
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
        abort_if($expense->user_id == auth()->id(), 403);

        $categories = Category::where('user_id', auth()->id())->get();

        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'expense_date' => 'required|date',
        ]);

        $expense->update($request->only([
            'category_id',
            'amount',
            'description',
            'expense_date',
        ]));

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
