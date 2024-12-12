@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white text-gray-500 text-xs min-h-10 min-w-80 py-2 px-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none']) }}>
