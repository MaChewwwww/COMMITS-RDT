@props([
    'label' => null, 
    'name' => null, 
    'value' => old($name), 
    'required' => false,
])

<div class="col-span-2 sm:col-span-1">
    <x-inventory.label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </x-inventory.label>

    <input 
        type="date" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
        @if ($required) required @endif
    >

    <x-inventory.error name="{{ $name }}" />
</div>