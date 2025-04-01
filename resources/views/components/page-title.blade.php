@props(['value'])

<h1 {{ $attributes->merge(['class' => 'mb-8 text-2xl font-medium']) }}>
    {{ $value ?? $slot }}
</h1>
