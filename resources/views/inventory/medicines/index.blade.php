@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="create-inventory-medicines" >
    <x-inventory.form method="POST" action="{{ route('add_medicine_store') }}">

        <!-- date_received -->

        <!-- expiration_date -->

        <!-- medicine_name -->

        <!-- stock_number -->

        <!-- unit_of_measurement-->

        <!-- initial_quantity -->

        <!-- user_id / memorandum_receipt -->


        <x-inventory.input
            label="Medicine Name" 
            name="medicine_name" 
            placeholder="Paracetamol 500mg"
            required
        />


    </x-inventory.form>
</x-inventory.modal>
@endsection

@section('inventory-table')
    Medicines Table
    <!-- 
        HEADERS 
        - Date Received
        - Stock #
        - Medicine (Name)
        - Unit (Measurement)
        - Quantity (Initial)
        - Consumed
        - Balance
        - Expiry Date
        - Memorandum Receipt (User)

        ROW ACTIONS
        - Info (Mobile screen, View Toggle)
        - Edit (Modal Form, Confirm Dialog before Update)
        - Delete (Soft)
        - Deduct (?)
    -->
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                @php
                    $headers = [
                        "Date Received",
                        "Stock #",
                        "Medicine",
                        "Unit",
                        "Quantity",
                        "Consumed",
                        "Balance",
                        "Expiry Date",
                        "Memorandum Receipt",
                        "Actions",
                    ];
    
                    foreach ($headers as $header) {
                        echo '<th scope="col" class="px-6 py-3">'.$header.'</th>';
                    }
                @endphp
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ \Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d') }}
                </td>
                <td class="px-6 py-4">
                    {{ $medicine->box->stock_number }}
                </td>
                <td class="px-6 py-4">
                    {{ $medicine->medicine_name }}
                </td>
                <td class="px-6 py-4">
                    {{ $medicine->unit }}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($medicine->initial_quantity) }}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($medicine->consumed_quantity) }}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($medicine->remaining_quantity) }}
                </td>
                <td class="px-6 py-4">
                    {{ \Carbon\Carbon::parse($medicine->expiration_date)->format("M' y") }}
                </td>
                <td class="px-6 py-4">
                    {{ $medicine->box->user->first_name." ".$medicine->box->user->last_name }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center gap-4">
                        <!-- Edit Button -->
                        <button data-modal-target="edit-modal-{{ Route::currentRouteName() }}-{{ $medicine->id }}" data-modal-toggle="edit-modal-{{ Route::currentRouteName() }}-{{ $medicine->id }}" class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>   
                        </button> 
    
                        <div class="">
                            <form method="POST" action="{{ route('delete_medicine', $medicine->id) }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white px-4 py-2 bg-red-500 rounded-lg hover:bg-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>  
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection


{{-- @section('inventory-table')
<table class="w-full text-sm text-left text-gray-500 rtl:text-right">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            @php
                $headers = [
                    "Date Received",
                    "Stock #",
                    "Medicine",
                    "Unit",
                    "Quantity",
                    "Consumed",
                    "Balance",
                    "Expiry Date",
                    "Memorandum Receipt",
                    "Actions",
                ];

                foreach ($headers as $header) {
                    echo '<th scope="col" class="px-6 py-3">'.$header.'</th>';
                }
            @endphp
        </tr>
    </thead>
    <tbody>
        @foreach ($medicines as $medicine)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ \Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d') }}
            </td>
            <td class="px-6 py-4">
                {{ $medicine->box->stock_number }}
            </td>
            <td class="px-6 py-4">
                {{ $medicine->medicine_name }}
            </td>
            <td class="px-6 py-4">
                {{ $medicine->unit }}
            </td>
            <td class="px-6 py-4">
                {{ number_format($medicine->initial_quantity) }}
            </td>
            <td class="px-6 py-4">
                {{ number_format($medicine->consumed_quantity) }}
            </td>
            <td class="px-6 py-4">
                {{ number_format($medicine->remaining_quantity) }}
            </td>
            <td class="px-6 py-4">
                {{ \Carbon\Carbon::parse($medicine->expiration_date)->format("M' y") }}
            </td>
            <td class="px-6 py-4">
                {{ $medicine->box->user->first_name." ".$medicine->box->user->last_name }}
            </td>
            <td class="px-6 py-4">
                <div class="flex justify-center gap-4">
                    <!-- Edit Button -->
                    <button data-modal-target="edit-modal-{{ Route::currentRouteName() }}-{{ $medicine->id }}" data-modal-toggle="edit-modal-{{ Route::currentRouteName() }}-{{ $medicine->id }}" class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                        </svg>   
                    </button> 

                    <div class="">
                        <form method="POST" action="{{ route('delete_medicine', $medicine->id) }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white px-4 py-2 bg-red-500 rounded-lg hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                </svg>  
                            </button>
                        </form>
                    </div>
                </div>

               
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $medicines->links() }}
@endsection --}}

 {{-- Edit Form  --}}
    {{-- <x-inventory.modal-form tab="inventory-medicines-{{ $medicine->id }}" type="edit" form_method="POST" :action="route('update_medicine', $medicine->id)" method="PUT">
        <x-slot:title>Edit Medicine</x-slot:title>

        <x-slot:body>
            <div class="col-span-1">
                <label for="date_received" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Received</label>
                
                <div class="relative max-w-sm">
                    <input id="date_received" name="date_received" type="date" value="{{ old('date_received', \Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d')) }}" class="w-full px-3 py-2 text-sm transition duration-300 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" required>
                    @error('date_received')
                        <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                    @enderror
                    </div>
            </div>

            <div class="col-span-1">
                <label for="expiration_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expiration Date</label>
                
                <div class="relative max-w-sm">
                    <input id="expiration_date" name="expiration_date" type="date" value="{{ old('expiration_date', \Carbon\Carbon::parse($medicine->expiration_date)->format('Y-m-d')) }}" class="w-full px-3 py-2 text-sm transition duration-300 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" required>
                    @error('expiration_date')
                        <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                    @enderror
                    </div>
            </div>

            <div class="col-span-1">
                <label for="medicine_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicine Name</label>
                <input type="text" name="medicine_name" id="medicine_name" value="{{ old('medicine_name', $medicine->medicine_name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type medicine name" required>
                @error('medicine_name')
                    <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="stock_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock #</label>
                <input type="text" name="stock_number" id="stock_number" value="{{ old('stock_number', $medicine->box->stock_number) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type stock number" required>
                @error('stock_number')
                    <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="unit_of_measurement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                <select id="unit_of_measurement" value="{{ old('unit_of_measurement', $medicine->unit) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="tablet">Tablet</option>
                    <option value="capsule">Capsule</option>
                </select>
                @error('unit_of_measurement')
                    <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="initial_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                <input type="number" id="initial_quantity" value="{{ old('initial_quantity', $medicine->initial_quantity) }}" min="{{ $medicine->consumed_quantity }}" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="100" required />
                @error('initial_quantity')
                    <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label for="user_id" class="block mb-2 text-sm text-slate-600">Memorandum Receipt</label>
                <select id="user_id" name="user_id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name." ".$user->last_name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>
        </x-slot:body>
    </x-inventory.modal-form> --}}
    