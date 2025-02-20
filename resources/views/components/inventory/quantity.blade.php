@props([
    'label' => null, 
    'name' => null, 
    'value' => old($name), 
    'min' => null, 
    'max' => null, 
    'step' => 1, 
    'placeholder' => '', 
    'required' => false,
])

<div class="col-span-2 sm:col-span-1">
    <x-inventory.label for="{{ $name }}">
        {{ $label }}
    </x-inventory.label>

    <input 
        type="number" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        min="{{ $min }}" 
        max="{{ $max }}" 
        step="{{ $step }}" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
        placeholder="{{ $placeholder }}"
        @if ($required) required @endif
    >
    
    <x-inventory.error name="{{ $name }}" />
</div> 