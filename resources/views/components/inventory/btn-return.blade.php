@props(['target'])

<button
    type="button"
    data-modal-target="{{ $target }}"
    data-modal-toggle="{{ $target }}"
    class="text-white px-3 py-2 bg-green-600 rounded-lg hover:bg-green-700"
>
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
  </svg>
</button>
