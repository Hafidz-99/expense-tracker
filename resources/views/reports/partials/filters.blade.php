<div class="p-6 bg-white border shadow-sm border-slate-200 rounded-2xl">
    <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700">Month</label>
            <input type="month" name="month" value="{{ $selectedMonth }}"
                class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700">Category</label>
            <select name="category_id"
                class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Categories</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700">Start Date</label>
            <input type="date" name="start_date" value="{{ $startDate }}"
                class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700">End Date</label>
            <input type="date" name="end_date" value="{{ $endDate }}"
                class="w-full mt-2 text-sm shadow-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="flex items-end gap-2">
            <button type="submit"
                class="w-full px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                Apply
            </button>

            <a href="{{ route('reports.index') }}"
                class="w-full px-4 py-2 text-sm font-semibold text-center text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200">
                Reset
            </a>

            <a href="{{ route('reports.print', request()->query()) }}" target="_blank"
                class="w-full px-4 py-2 text-sm font-semibold text-center text-white bg-slate-900 rounded-xl hover:bg-slate-800">
                Print
            </a>

            <a href="{{ route('reports.pdf', request()->query()) }}"
                class="w-full px-4 py-2 text-sm font-semibold text-center text-white bg-red-600 rounded-xl hover:bg-red-700">
                PDF
            </a>

            <a href="{{ route('reports.excel', request()->query()) }}"
                class="w-full px-4 py-2 text-sm font-semibold text-center text-white bg-green-600 rounded-xl hover:bg-green-700">
                Excel
            </a>
        </div>
    </form>
</div>
