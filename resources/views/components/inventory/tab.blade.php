@props(['href', 'active' => false])

<a href="{{ $href }}" class="text-lg text-gray-500 px-4 py-2 border-b-2 border-gray-200 rounded cursor-pointer
    {{ $active ? 'text-gray-800 border-indigo-500'  : 'hover:text-gray-700 hover:border-gray-300' }}">
    {{ $slot }}
</a>