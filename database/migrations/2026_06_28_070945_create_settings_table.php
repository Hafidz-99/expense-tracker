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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('theme')->default('system');
            $table->string('currency')->default('MYR');
            $table->string('date_format')->default('d/m/Y');
            $table->string('time_format')->default('24');
            $table->string('timezone')->default('Asia/Kuala_Lumpur');

            $table->unsignedTinyInteger('first_day_of_week')->default(1);
            $table->foreignId('default_category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->unsignedTinyInteger('decimal_precision')->default(2);
            $table->string('default_dashboard_period')->default('monthly');
            $table->json('dashboard_cards')->nullable();

            $table->timestamps();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
