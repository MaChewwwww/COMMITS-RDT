@props(['name'])

@error($name)
    <p class="text-red-600 text-sm">{{ $message }}</p>
@enderror
