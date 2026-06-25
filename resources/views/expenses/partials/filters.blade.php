<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <form method="GET" action="{{ route('expenses.index') }}">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Month
                </label>

                <select name="month" onchange="this.form.submit()"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    @foreach (range(1, 12) as $month)
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

                <select name="year" onchange="this.form.submit()"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
                    @foreach (range(now()->year, now()->year - 5) as $year)
                        <option value="{{ $year }}" @selected((int) $selectedYear === $year)>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">
                    Category
                </label>

                <select name="category_id" onchange="this.form.submit()"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">
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
                    class="w-full px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold rounded-xl border border-slate-200 text-center transition">
                    Reset
                </a>
            </div>
        </div>
    </form>
</div>
