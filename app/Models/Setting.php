<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'theme',
    'default_category_id',
    'decimal_precision',
    'default_dashboard_period',
    'dashboard_cards',
    'default_expense_date',
    'monthly_budget_reminder',
    'recent_expenses_count',
    'show_budget_progress',
    'show_category_breakdown',
    'show_recent_expenses',
])]
class Setting extends Model
{
    protected $casts = [
        'dashboard_cards' => 'array',
        'first_day_of_week' => 'integer',
        'decimal_precision' => 'integer',
        'monthly_budget_reminder' => 'boolean',
        'recent_expenses_count' => 'integer',
        'show_budget_progress' => 'boolean',
        'show_category_breakdown' => 'boolean',
        'show_recent_expenses' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
