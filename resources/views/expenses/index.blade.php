<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-lg font-bold text-slate-900">
                Expenses
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Add, filter and manage your daily spending records.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- Add Expense --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-base font-bold text-slate-900">
                    Add Expense
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Record a new transaction.
                </p>
            </div>

            <form method="POST" action="{{ route('expenses.store') }}" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Category
                        </label>

                        <select name="category_id"
                                class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                            <option value="">Select category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               name="amount"
                               value="{{ old('amount') }}"
                               placeholder="0.00"
                               class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

                        @error('amount')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Description
                        </label>

                        <input type="text"
                               name="description"
                               value="{{ old('description') }}"
                               placeholder="What was this for?"
                               class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

                        @error('description')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Date
                        </label>

                        <input type="date"
                               name="expense_date"
                               value="{{ old('expense_date', now()->format('Y-m-d')) }}"
                               class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

                        @error('expense_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 flex justify-end">
                    <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                        Save Expense
                    </button>
                </div>
            </form>
        </div>

        {{-- Filters --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
            <form method="GET" action="{{ route('expenses.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Month
                        </label>

                        <select
                            name="month"
                            onchange="this.form.submit()"
                            class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" @selected((int) $selectedMonth === $month)>
                                    {{ \Carbon\Carbon::create(null, $month, 1)->format('F') }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Year
                        </label>

                        <select
                            name="year"
                            onchange="this.form.submit()"
                            class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">

                            @foreach(range(now()->year, now()->year-5) as $year)
                                <option value="{{ $year }}"
                                    @selected($selectedYear == $year)>
                                    {{ $year }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Category
                        </label>

                        <select
                            name="category_id"
                            onchange="this.form.submit()"
                            class="mt-2 w-full rounded-xl border-slate-300 text-slate-700 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                            <option value="">All categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <a href="{{ route('expenses.index') }}"
                           class="flex-1 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold rounded-xl border border-slate-200 text-center transition">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Expense List --}}
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Expense List
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $expenses->count() }} records found.
                        </p>
                    </div>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($expenses as $expense)
                        <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-sm font-extrabold text-slate-900">
                                        RM {{ number_format($expense->amount, 2) }}
                                    </p>

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600">
                                        {{ $expense->category->name }}
                                    </span>
                                </div>

                                <div class="mt-1 flex items-center gap-3 flex-wrap">
                                    <p class="text-xs text-slate-500">
                                        {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                                    </p>

                                    @if ($expense->description)
                                        <p class="text-xs text-slate-500 truncate max-w-sm">
                                            {{ $expense->description }}
                                        </p>
                                    @else
                                        <p class="text-xs text-slate-400">
                                            No description
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <a href="{{ route('expenses.edit', $expense) }}"
                                   class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('expenses.destroy', $expense) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Delete this expense?')"
                                            class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-14 text-center">
                            <div class="mx-auto w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                +
                            </div>

                            <h3 class="mt-4 text-sm font-bold text-slate-900">
                                No expenses found
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Add your first expense or adjust your filters.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Monthly Summary --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Monthly Summary
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Spending by category.
                        </p>
                    </div>

                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">
                        {{ \Carbon\Carbon::create(null, (int) $selectedMonth, 1)->format('M') }} {{ $selectedYear }}
                    </span>
                </div>

                <div class="mt-6 space-y-5">
                    @php
                        $summaryTotal = $monthlySummary->sum('total');
                    @endphp

                    @forelse ($monthlySummary as $summary)
                        @php
                            $percentage = $summaryTotal > 0
                                ? round(($summary->total / $summaryTotal) * 100)
                                : 0;
                        @endphp

                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm font-semibold text-slate-700 truncate">
                                    {{ $summary->category->name }}
                                </p>

                                <p class="text-sm font-bold text-slate-900 shrink-0">
                                    RM {{ number_format($summary->total, 2) }}
                                </p>
                            </div>

                            <div class="mt-2 flex items-center gap-3">
                                <div class="h-2 flex-1 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-blue-600"
                                         style="width: {{ $percentage }}%"></div>
                                </div>

                                <span class="w-10 text-right text-xs font-semibold text-slate-500">
                                    {{ $percentage }}%
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <div class="mx-auto w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                %
                            </div>

                            <h3 class="mt-4 text-sm font-bold text-slate-900">
                                No summary yet
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Add expenses to see category totals.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>