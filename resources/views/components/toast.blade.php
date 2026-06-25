@if (session('success') || session('error') || session('warning'))
    @php
        if (session('success')) {
            $type = 'success';
            $message = session('success');
        } elseif (session('warning')) {
            $type = 'warning';
            $message = session('warning');
        } else {
            $type = 'error';
            $message = session('error');
        }

        $styles = [
            'success' => 'bg-green-50 border-green-200 text-green-700',
            'warning' => 'bg-amber-50 border-amber-200 text-amber-700',
            'error' => 'bg-red-50 border-red-200 text-red-700',
        ];
    @endphp

    <div id="toast"
        class="fixed top-6 right-6 z-[9999] w-96 max-w-[90vw] rounded-2xl border shadow-xl px-5 py-4 {{ $styles[$type] }}
               transition-all duration-300 translate-x-[120%] opacity-0">

        <div class="flex items-start gap-3">

            <div class="mt-0.5">
                @if ($type == 'success')
                    ✓
                @elseif($type == 'warning')
                    ⚠
                @else
                    ✕
                @endif
            </div>

            <div class="flex-1">
                <p class="font-semibold capitalize">
                    {{ $type }}
                </p>

                <p class="mt-1 text-sm">
                    {{ $message }}
                </p>
            </div>

            <button onclick="closeToast()" class="text-lg leading-none opacity-60 hover:opacity-100">
                ×
            </button>

        </div>
    </div>

    <script>
        const toast = document.getElementById('toast');

        requestAnimationFrame(() => {
            toast.classList.remove('translate-x-[120%]', 'opacity-0');
        });

        function closeToast() {
            toast.classList.add('translate-x-[120%]', 'opacity-0');

            setTimeout(() => {
                toast.remove();
            }, 300);
        }

        setTimeout(closeToast, 4000);
    </script>
@endif
