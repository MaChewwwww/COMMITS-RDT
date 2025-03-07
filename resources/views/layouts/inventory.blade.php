@extends('layouts.app-layout')

@section('content')
    <div class="container flex flex-col mx-auto">
        <h1 class="mb-8 text-3xl font-semibold">Inventory</h1>

        <div class="relative space-y-4">
            <div class="flex flex-col gap-4 sm:gap-8 sm:flex-row sm:items-center sm:justify-between">
                {{-- Tab Links --}}
                <div class="flex flex-col text-center sm:flex-row sm:gap-4">
                    <x-inventory.tab :href="route('inventory-medicines')" :active="request()->is('inventory/medicines*') || request()->is('inventory')">Medicines</x-inventory.tab>
                    <x-inventory.tab
                        :href="route('inventory-supplies')"
                        :active="request()->routeIs('inventory-supplies') || request()->routeIs('supplies.*')">
                        Supplies
                    </x-inventory.tab>
                    <x-inventory.tab :href="route('inventory-equipment')" :active="request()->is('inventory/equipment*')">Equipment</x-inventory.tab>
                </div>

                <button data-modal-target="create-{{ Route::currentRouteName() }}" data-modal-toggle="create-{{ Route::currentRouteName() }}" class="self-center h-12 px-4 py-2 text-lg font-semibold text-center text-white transition-all bg-blue-500 border border-transparent rounded-lg shadow-md sm:self-end w-28 hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-600 hover:bg-blue-600 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                        <p>Add</p>
                    </div>
                </button>
            </div>

            {{-- Add Form --}}
            @yield('inventory-add')

            {{-- Display Errors --}}
            @if ($errors->has('password'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                    {{ $errors->first('password') }}
                </div>
            @endif

            {{-- Table --}}
            @yield('inventory-table')

        </div>
    </div>
@endsection

