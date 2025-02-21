@props([
    'label' => null, 
    'name' => null, 
    'value' => old($name), 
    'placeholder' => '',
    'type' => 'text',
    'required' => false,
])

<div class="col-span-2 sm:col-span-1">
    <x-inventory.label for="{{ $name }}">
        {{ $label }}
    </x-inventory.label>
    
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
        placeholder="{{ $placeholder }}"
        @if ($required) required @endif
    >

    <x-inventory.error name="{{ $name }}" />
</div>
