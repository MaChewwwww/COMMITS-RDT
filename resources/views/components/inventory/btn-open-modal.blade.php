@props([
    'target' => null,
    'type' => 'create',
    'model' => null
])

<button 
    type="button"
    data-modal-target="{{ $type }}-{{ Route::currentRouteName() }}" 
    data-modal-toggle="create-{{ Route::currentRouteName() }}" 
    class="self-center sm:self-end w-28 h-12 rounded-lg bg-blue-500 py-2 px-4 sm:mr-[52px] border border-transparent text-center text-lg font-semibold text-white transition-all shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-600 hover:bg-blue-600 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" 
>
    <div class="flex gap-1 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
        </svg>
        <p>{{ ucfirst($type) }}</p>
    </div>
</button>  