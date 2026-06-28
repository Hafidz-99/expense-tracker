<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    protected $fillable = [
        'user_id',
        'theme',
        'currency',
        'date_format',
        'time_format',
        'timezone',
        'first_day_of_week',
        'default_category_id',
        'decimal_precision',
        'default_dashboard_period',
        'dashboard_cards',
    ];

    protected $casts = [
        'dashboard_cards' => 'array',
        'first_day_of_week' => 'integer',
        'decimal_precision' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
