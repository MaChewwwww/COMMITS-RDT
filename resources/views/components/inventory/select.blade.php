@props([
    'label' => null, 
    'name' => null, 
    'selected' => old($name), 
    'options' => [], 
    'placeholder' => 'Select an option', 
    'required' => false,
])

<div class="col-span-2 sm:col-span-1">
    <x-inventory.label for="{{ $name }}">
        {{ $label }}
    </x-inventory.label>

    <select 
        id="{{ $name }}" 
        name="{{ $name }}" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        @if ($required) required @endif
    >
        <option value="" disabled selected>{{ $placeholder }}</option>
        
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected($selected == $value)>{{ $text }}</option>
        @endforeach
    </select>

    <x-inventory.error name="{{ $name }}" />
</div>