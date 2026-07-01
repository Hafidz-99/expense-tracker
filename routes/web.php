<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::put('/dashboard/preferences', 'updatePreferences')->name('dashboard.preferences.update');
    });

    Route::controller(ProfileController::class)
        ->prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
        });

    Route::resource('categories', CategoryController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('expenses', ExpenseController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('budgets', BudgetController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::controller(ReportController::class)
        ->prefix('reports')
        ->name('reports.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/print', 'print')->name('print');
            Route::get('/pdf', 'pdf')->name('pdf');
            Route::get('/excel', 'excel')->name('excel');
            Route::post('/import', 'import')->name('import');
            Route::get('/import/template', 'downloadImportTemplate')->name('import.template');
        });

    Route::controller(SettingController::class)
        ->prefix('settings')
        ->name('settings.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');

            Route::delete('/reset/expenses', 'resetExpenses')->name('reset.expenses');
            Route::delete('/reset/budgets', 'resetBudgets')->name('reset.budgets');
            Route::delete('/reset/all', 'resetAll')->name('reset.all');
        });
});

require __DIR__.'/auth.php';
