<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $setting = $user->setting()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        $storageStats = [
            'categories' => $user->categories()->count(),
            'expenses' => $user->expenses()->count(),
            'budgets' => $user->budgets()->count(),
        ];

        return view('settings.index', compact(
            'setting',
            'storageStats',
        ));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'theme' => ['required', 'in:light,dark'],
        ]);

        $request->user()
            ->setting()
            ->updateOrCreate(
                ['user_id' => $request->user()->id],
                $validated
            );

        return back()->with('success', 'Preferences updated successfully.');
    }

    public function resetExpenses(): RedirectResponse
    {
        request()->user()->expenses()->delete();

        return back()->with('success', 'All expenses have been deleted successfully.');
    }

    public function resetBudgets(): RedirectResponse
    {
        request()->user()->budgets()->delete();

        return back()->with('success', 'All budgets have been deleted successfully.');
    }

    public function resetAll(): RedirectResponse
    {
        $user = request()->user();

        DB::transaction(function () use ($user) {
            $user->expenses()->delete();
            $user->budgets()->delete();
            $user->categories()->delete();

            $user->setting()->update([
                'theme' => 'system',
            ]);
        });

        return back()->with('success', 'All application data has been reset successfully.');
    }
}
