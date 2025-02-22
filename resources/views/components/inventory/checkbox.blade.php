@props([
    'label' => null, 
    'name' => null, 
    'checked' => old($name, false), 
    'required' => false,
])

<div class="flex gap-x-4 items-center col-span-2 sm:col-span-1">
    <input 
        type="checkbox" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        @checked($checked) 
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500"
        @if ($required) required @endif
    >

    <x-inventory.label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </x-inventory.label>

    <x-inventory.error name="{{ $name }}" />
</div>
