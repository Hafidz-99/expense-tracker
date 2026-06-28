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
        ]);

        $validated['monthly_budget_reminder'] = $request->boolean('monthly_budget_reminder');

        $request->user()
            ->setting()
            ->updateOrCreate(
                ['user_id' => $request->user()->id],
                $validated
            );

        return back()->with('success', 'Preferences updated successfully.');
    }
}
