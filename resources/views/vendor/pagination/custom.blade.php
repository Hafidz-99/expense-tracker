@if ($paginator->hasPages())
    <nav class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-slate-500">
            Showing
            <span class="font-semibold text-slate-700">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-semibold text-slate-700">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-semibold text-slate-700">{{ $paginator->total() }}</span>
            results
        </p>

        <div class="flex items-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-sm font-semibold border rounded-xl text-slate-400 border-slate-200">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-2 text-sm font-semibold border rounded-xl text-slate-700 border-slate-200 hover:bg-slate-50">
                    Previous
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-sm text-slate-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 text-sm font-bold text-white bg-blue-600 rounded-xl">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-2 text-sm font-semibold border rounded-xl text-slate-700 border-slate-200 hover:bg-slate-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-2 text-sm font-semibold border rounded-xl text-slate-700 border-slate-200 hover:bg-slate-50">
                    Next
                </a>
            @else
                <span class="px-3 py-2 text-sm font-semibold border rounded-xl text-slate-400 border-slate-200">
                    Next
                </span>
            @endif
        </div>
    </nav>
@endif
