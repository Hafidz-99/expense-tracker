<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BudgetController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'year' => ['nullable', 'integer', 'min:2020', 'max:2100'],
            'status' => ['nullable', 'in:all,on_track,near_limit,over_budget'],
            'sort' => ['nullable', 'in:latest,oldest,highest,lowest'],
        ]);

        $budgetCollection = Budget::where('user_id', Auth::id())
            ->when($request->filled('year'), function ($query) use ($request) {
                $query->where('year', $request->year);
            })
            ->get()
            ->map(function ($budget) {
                $spent = Expense::where('user_id', Auth::id())
                    ->whereYear('expense_date', $budget->year)
                    ->whereMonth('expense_date', $budget->month)
                    ->sum('amount');

                $percentage = $budget->amount > 0
                    ? round(($spent / $budget->amount) * 100)
                    : 0;

                $budget->spent = $spent;
                $budget->remaining = $budget->amount - $spent;
                $budget->percentage = $percentage;

                $budget->status = match (true) {
                    $percentage >= 100 => 'over_budget',
                    $percentage >= 80 => 'near_limit',
                    default => 'on_track',
                };

                return $budget;
            });

        if ($request->filled('status') && $request->status !== 'all') {
            $budgetCollection = $budgetCollection->where('status', $request->status);
        }

        $budgetCollection = match ($request->sort) {
            'oldest' => $budgetCollection
                ->sortBy('month')
                ->sortBy('year'),

            'highest' => $budgetCollection
                ->sortByDesc('amount'),

            'lowest' => $budgetCollection
                ->sortBy('amount'),

            default => $budgetCollection
                ->sortByDesc('month')
                ->sortByDesc('year'),
        };

        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $budgets = new LengthAwarePaginator(
            $budgetCollection->forPage($currentPage, $perPage),
            $budgetCollection->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        $currentMonth = now()->month;
        $currentYear = now()->year;

        $currentBudget = Budget::where('user_id', Auth::id())
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();

        $currentSpending = Expense::where('user_id', Auth::id())
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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'month' => [
                'required',
                'integer',
                'between:1,12',
                Rule::unique('budgets')->where(function ($query) use ($request) {
                    return $query
                        ->where('user_id', Auth::id())
                        ->where('year', $request->year);
                }),
            ],
            'year' => ['required', 'integer', 'min:2020', 'max:2100'],
        ], [
            'month.unique' => 'A budget for this month and year already exists.',
        ]);

        Budget::updateOrCreate(
            [
                'user_id' => Auth::id(),
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

    public function update(Request $request, Budget $budget): RedirectResponse
    {
        abort_if($budget->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'month' => [
                'required',
                'integer',
                'between:1,12',
                Rule::unique('budgets')->where(function ($query) use ($request) {
                    return $query
                        ->where('user_id', Auth::id())
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

    public function destroy(Budget $budget): RedirectResponse
    {
        abort_if($budget->user_id !== Auth::id(), 403);

        $budget->delete();

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Budget deleted successfully.');
    }
}
