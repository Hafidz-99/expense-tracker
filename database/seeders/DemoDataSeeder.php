<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command?->info('Demo user created.');

        $this->clearDemoData($user->id);

        $categories = $this->createDemoCategories($user->id);

        $this->createDemoExpenses($user->id, $categories);

        $this->command?->info('Demo data seeded successfully.');
    }

    private function clearDemoData(int $userId): void
    {
        if (Schema::hasTable('expenses') && Schema::hasColumn('expenses', 'user_id')) {
            DB::table('expenses')->where('user_id', $userId)->delete();
        }

        if (Schema::hasTable('budgets') && Schema::hasColumn('budgets', 'user_id')) {
            DB::table('budgets')->where('user_id', $userId)->delete();
        }

        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'user_id')) {
            DB::table('categories')->where('user_id', $userId)->delete();
        }

        $this->command?->info('Old demo data cleared.');
    }

    private function createDemoCategories(int $userId): array
    {
        $items = [
            ['name' => 'Food', 'color' => '#2563EB'],
            ['name' => 'Transport', 'color' => '#16A34A'],
            ['name' => 'Bills', 'color' => '#EA580C'],
            ['name' => 'Shopping', 'color' => '#DB2777'],
            ['name' => 'Health', 'color' => '#DC2626'],
            ['name' => 'Entertainment', 'color' => '#7C3AED'],
            ['name' => 'Education', 'color' => '#0891B2'],
        ];

        $categories = [];

        foreach ($items as $item) {
            $category = Category::create([
                'user_id' => $userId,
                'name' => $item['name'],
                'color' => $item['color'],
            ]);

            $categories[$item['name']] = $category;
        }

        $this->command?->info('Demo categories created.');

        return $categories;
    }

    private function createDemoExpenses(int $userId, array $categories): void
    {
        $months = collect(range(0, 5))
            ->map(fn ($index) => now()->subMonths($index)->startOfMonth())
            ->reverse()
            ->values();

        foreach ($months as $monthIndex => $month) {
            $baseIncrease = $monthIndex * 5;

            $expenses = [
                [
                    'category' => 'Food',
                    'day' => 3,
                    'amount' => 18.50 + $baseIncrease,
                    'description' => 'Lunch at restaurant',
                ],
                [
                    'category' => 'Food',
                    'day' => 12,
                    'amount' => 42.90 + $baseIncrease,
                    'description' => 'Groceries',
                ],
                [
                    'category' => 'Transport',
                    'day' => 5,
                    'amount' => 12.00,
                    'description' => 'Fuel / public transport',
                ],
                [
                    'category' => 'Bills',
                    'day' => 8,
                    'amount' => 95.00 + ($monthIndex * 3),
                    'description' => 'Phone and utilities bill',
                ],
                [
                    'category' => 'Shopping',
                    'day' => 15,
                    'amount' => 68.00 + $baseIncrease,
                    'description' => 'Clothing and personal items',
                ],
                [
                    'category' => 'Health',
                    'day' => 18,
                    'amount' => 35.00,
                    'description' => 'Medicine / clinic',
                ],
                [
                    'category' => 'Entertainment',
                    'day' => 22,
                    'amount' => 29.90,
                    'description' => 'Movie / streaming',
                ],
                [
                    'category' => 'Education',
                    'day' => 26,
                    'amount' => 45.00,
                    'description' => 'Online course / learning material',
                ],
            ];

            foreach ($expenses as $expense) {
                $date = $month->copy()->day(
                    min($expense['day'], $month->daysInMonth)
                );

                $payload = [
                    'user_id' => $userId,
                    'category_id' => $categories[$expense['category']]->id,
                    'amount' => $expense['amount'],
                    'expense_date' => $date->toDateString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (Schema::hasColumn('expenses', 'description')) {
                    $payload['description'] = $expense['description'];
                }

                if (Schema::hasColumn('expenses', 'note')) {
                    $payload['note'] = $expense['description'];
                }

                DB::table('expenses')->insert($payload);
            }
        }

        $this->command?->info('Demo expenses created.');
    }
}
