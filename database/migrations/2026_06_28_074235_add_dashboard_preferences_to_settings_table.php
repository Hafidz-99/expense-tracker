<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->unsignedTinyInteger('recent_expenses_count')->default(5);
            $table->boolean('show_budget_progress')->default(true);
            $table->boolean('show_category_breakdown')->default(true);
            $table->boolean('show_recent_expenses')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'recent_expenses_count',
                'show_budget_progress',
                'show_category_breakdown',
                'show_recent_expenses',
            ]);
        });
    }
};
