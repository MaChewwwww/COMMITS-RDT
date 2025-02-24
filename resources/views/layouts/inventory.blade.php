@extends('layouts.app-layout')

@section('content')
    <div class="container flex flex-col mx-auto">
        <h1 class="text-3xl font-semibold mb-8">Inventory</h1>

        <div class="relative space-y-4">
            <div class="flex flex-col gap-4 sm:gap-8 sm:flex-row sm:items-center sm:justify-between">
                {{-- Tab Links --}}
                <div class="flex flex-col text-center sm:flex-row sm:gap-4">
                    <x-inventory.tab :href="route('inventory-medicines')" :active="request()->is('inventory/medicines*') || request()->is('inventory')">Medicines</x-inventory.tab>
                    <x-inventory.tab :href="route('inventory-supplies')" :active="request()->is('inventory/supplies*')">Supplies</x-inventory.tab>
                    <x-inventory.tab :href="route('inventory-equipment')" :active="request()->is('inventory/equipment*')">Equipment</x-inventory.tab>
                </div>   
                
                <button data-modal-target="create-{{ Route::currentRouteName() }}" data-modal-toggle="create-{{ Route::currentRouteName() }}" class="self-center sm:self-end w-28 h-12 rounded-lg bg-blue-500 py-2 px-4  border border-transparent text-center text-lg font-semibold text-white transition-all shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-600 hover:bg-blue-600 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    <div class="flex gap-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                        <p>Add</p>
                    </div>
                </button>       
            </div>

            {{-- Add Form --}}
            @yield('inventory-add')
            
            {{-- Table --}}
            @yield('inventory-table')

        </div>
    </div>
@endsection

