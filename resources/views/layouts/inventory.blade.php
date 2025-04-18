@extends('layouts.app-layout')

@section('title', 'Inventory')

@section('content')
    <div class="flex flex-col mx-auto">
        <x-page-title class="mb-8" value="Inventory" />

        <div class="relative space-y-4 bg-white p-4 shadow rounded-lg">
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

                <button data-modal-target="create-{{ Route::currentRouteName() }}" data-modal-toggle="create-{{ Route::currentRouteName() }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-white bg-blue-500 hover:bg-blue-600 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg active:shadow-sm transform active:translate-y-0" type="button">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
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

