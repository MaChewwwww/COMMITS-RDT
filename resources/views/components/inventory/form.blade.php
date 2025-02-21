@props(['method', 'action'])

<form 
    method="{{ $method }}"
    action="{{ $action }}"
    class="p-4 md:p-5"
>
    @csrf
    @if ($method != 'POST')
        @method($method)
    @endif

    <div class="grid gap-4 mb-4 grid-cols-2">
        {{ $slot }}
    </div>

    <x-inventory.btn-submit-form />
</form>
