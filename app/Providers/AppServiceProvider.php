<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $view->with('layoutCategories', auth()->check()
                ? Category::where('user_id', auth()->id())->orderBy('name')->get()
                : collect()
            );
        });

        View::composer('*', function ($view) {
            $theme = 'light';

            if (Auth::check()) {
                $theme = Setting::where('user_id', Auth::id())
                    ->value('theme') ?? 'light';
            }

            $view->with('theme', $theme);
        });
    }
}
