<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::where('user_id', auth()->id())
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        $currentMonth = now()->month;
        $currentYear = now()->year;

        $currentBudget = Budget::where('user_id', auth()->id())
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();

        $currentSpending = Expense::where('user_id', auth()->id())
            ->whereYear('expense_date', $currentYear)
            ->whereMonth('expense_date', $currentMonth)
            ->sum('amount');

        $currentBudgetAmount = $currentBudget?->amount ?? 0;
        $currentRemaining = $currentBudgetAmount - $currentSpending;

        return view('budgets.index', compact(
            'budgets',
            'currentBudgetAmount',
            'currentSpending',
            'currentRemaining'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'month' => [
                'required',
                'integer',
                'between:1,12',
                Rule::unique('budgets')->where(function ($query) use ($request) {
                    return $query
                        ->where('user_id', auth()->id())
                        ->where('year', $request->year);
                }),
            ],
            'year' => ['required', 'integer', 'min:2020', 'max:2100'],
        ], [
            'month.unique' => 'A budget for this month and year already exists.',
        ]);

        Budget::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'month' => $validated['month'],
                'year' => $validated['year'],
            ],
            [
                'amount' => $validated['amount'],
            ]
        );

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Budget saved successfully.');
    }

    public function update(Request $request, Budget $budget)
    {
        abort_if($budget->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'month' => [
                'required',
                'integer',
                'between:1,12',
                Rule::unique('budgets')->where(function ($query) use ($request) {
                    return $query
                        ->where('user_id', auth()->id())
                        ->where('year', $request->year);
                })->ignore($budget->id),
            ],
            'year' => ['required', 'integer', 'min:2020', 'max:2100'],
        ], [
            'month.unique' => 'A budget for this month and year already exists.',
        ]);

        $budget->update($validated);

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Budget updated successfully.');
    }

    public function destroy(Budget $budget)
    {
        abort_if($budget->user_id !== auth()->id(), 403);

        $budget->delete();

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Budget deleted successfully.');
    }
}
