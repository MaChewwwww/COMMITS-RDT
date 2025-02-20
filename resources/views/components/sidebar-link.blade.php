@props(['href', 'active' => false, 'icon'])

<a href="{{ $href }}" 
   class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group
   {{ $active ? 'text-red-900 bg-gray-100' : '' }}"
>
    <i class="{{ $icon }} {{ $active ? 'text-red-800' : '' }} w-6 h-5 text-gray-300 transition duration-75 group-hover:text-red-800"></i>
    <span class="ml-3">{{ $slot }}</span>
</a>
    