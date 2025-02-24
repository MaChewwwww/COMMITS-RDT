@props([
    'name',
    'label' => null, 
    'value' => 0,
    'checked' => old($name, false), 
    'required' => false,
])

<li class="w-full border-b border-gray-200 rounded-t-lg">
    <div class="flex items-center ps-3">
        <input id="{{ $name }}" type="checkbox" value="{{ $checked ? 1 : 0 }}" {{ $checked ? 'checked' : '' }}  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
        <label for="{{ $name }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    </div>
</li>

<x-inventory.error name="{{ $name }}" />
