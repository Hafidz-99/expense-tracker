<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = $request->user()->setting()->firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        $categories = Category::where('user_id', $request->user()->id)
            ->orderBy('name')
            ->get();

        return view('settings.index', compact(
            'setting',
            'categories',
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => ['sometimes', 'required', 'in:light,dark,system'],
            'currency' => ['sometimes', 'required', 'string', 'max:10'],
            'date_format' => ['sometimes', 'required', 'string'],
            'time_format' => ['sometimes', 'required', 'in:12,24'],
            'timezone' => ['sometimes', 'required', 'timezone'],

            'default_category_id' => ['nullable', 'exists:categories,id'],
            'default_expense_date' => ['sometimes', 'required', 'in:today,blank'],
            'decimal_precision' => ['sometimes', 'required', 'integer', 'min:0', 'max:4'],
            'first_day_of_week' => ['sometimes', 'required', 'integer', 'min:0', 'max:6'],
            'monthly_budget_reminder' => ['nullable', 'boolean'],

            'default_dashboard_period' => ['sometimes', 'required', 'in:monthly,yearly,all_time'],
            'recent_expenses_count' => ['sometimes', 'required', 'integer', 'min:3', 'max:10'],
            'show_budget_progress' => ['nullable', 'boolean'],
            'show_category_breakdown' => ['nullable', 'boolean'],
            'show_recent_expenses' => ['nullable', 'boolean'],
        ]);

        // $validated['monthly_budget_reminder'] = $request->boolean('monthly_budget_reminder');

        foreach ([
            'monthly_budget_reminder',
            'show_budget_progress',
            'show_category_breakdown',
            'show_recent_expenses',
        ] as $checkbox) {
            if ($request->has($checkbox) || $request->hasAny([
                'default_dashboard_period',
                'recent_expenses_count',
            ])) {
                $validated[$checkbox] = $request->boolean($checkbox);
            }
        }

        $request->user()
            ->setting()
            ->updateOrCreate(
                ['user_id' => $request->user()->id],
                $validated
            );

        return back()->with('success', 'Preferences updated successfully.');
    }
}
