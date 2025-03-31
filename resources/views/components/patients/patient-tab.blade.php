@props(['filter', 'active' => false])

@php
    $classes = $active
        ? 'px-4 py-2 text-sm font-medium text-red-700 border-b-2 border-red-700 whitespace-nowrap'
        : 'px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent whitespace-nowrap hover:text-red-700 hover:border-b-2 hover:border-red-700';
@endphp

<button type="button" class="{{ $classes }}" data-filter="{{ $filter }}">
    {{ $slot }}
</button>
