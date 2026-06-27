@props([
    'type' => 'text',
])

<input type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'block w-full mt-1 border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500',
    ]) }}>
