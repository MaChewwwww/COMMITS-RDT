@props(['method' => 'POST', 'action'])

<form 
    method="{{ in_array(strtoupper($method), ['GET', 'POST']) ? $method : 'POST' }}" 
    action="{{ $action }}" 
    {{ $attributes->merge(['class' => 'p-4 md:p-5']) }}
>
    @csrf
    @if (!in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        {{ $slot }}
    </div>

    <x-inventory.btn-submit-form />
</form>
