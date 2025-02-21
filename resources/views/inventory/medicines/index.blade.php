@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="create-inventory-medicines">
    <x-inventory.form method="POST" action="{{ route('add_medicine_store') }}">
        
        <!-- Date Received -->
        <x-inventory.date
            label="Date Received" 
            name="date_received" 
            required
        />

        <!-- Expiration Date -->
        <x-inventory.date
            label="Expiration Date" 
            name="expiration_date" 
            required
        />

        <!-- Medicine Name -->
        <x-inventory.input
            label="Medicine Name" 
            name="medicine_name" 
            placeholder="Paracetamol 500mg"
            required
        />

        <!-- Stock Number -->
        <x-inventory.input
            label="Stock Number" 
            name="stock_number" 
            placeholder="STK-001"
            required
        />

        <!-- Unit of Measurement -->
        <x-inventory.input
            label="Unit of Measurement" 
            name="unit_of_measurement" 
            placeholder="Capsule"
            required
        />

        <!-- Initial Quantity -->
        <x-inventory.quantity
            label="Initial Quantity" 
            name="initial_quantity" 
            placeholder="100"
            min="0"
            step="1"
            required
        />

        <!-- User/Memorandum Receipt -->
        <x-inventory.select
            label="Memorandum Receipt"
            name="user_id"
            :options="$users->pluck('full_name', 'id')->toArray()"
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
                        <button 
                            data-modal-target="edit-medicine-modal-{{ $medicine->id }}" 
                            data-modal-toggle="edit-medicine-modal-{{ $medicine->id }}" 
                            class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600" 
                            type="button"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>   
                        </button> 
    
                        <div class="">
                            <form method="POST" action="{{ route('delete_medicine', $medicine->id) }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
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

    @foreach ($medicines as $medicine)
        <x-inventory.modal target="edit-medicine-modal-{{ $medicine->id }}">
            <x-inventory.form method="PUT" action="{{ route('update_medicine', $medicine->id) }}">
                <!-- Date Received -->
                <x-inventory.date
                    label="Date Received" 
                    name="date_received" 
                    :value="\Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d')"
                    required
                />

                <!-- Expiration Date -->
                <x-inventory.date
                    label="Expiration Date" 
                    name="expiration_date" 
                    :value="\Carbon\Carbon::parse($medicine->expiration_date)->format('Y-m-d')"
                    required
                />

                <!-- Medicine Name -->
                <x-inventory.input
                    label="Medicine Name" 
                    name="medicine_name" 
                    :value="$medicine->medicine_name"
                    placeholder="Paracetamol 500mg"
                    required
                />

                <!-- Stock Number -->
                <x-inventory.input
                    label="Stock Number" 
                    name="stock_number" 
                    :value="$medicine->box->stock_number"
                    placeholder="STK-001"
                    required
                />

                <!-- Unit of Measurement -->
                <x-inventory.select
                    label="Unit of Measurement"
                    name="unit_of_measurement"
                    :options="[
                        'tablet' => 'Tablet',
                        'capsule' => 'Capsule',
                        'bottle' => 'Bottle',
                        'box' => 'Box'
                    ]"
                    :selected="$medicine->unit"
                    required
                />

                <!-- Initial Quantity -->
                <x-inventory.quantity
                    label="Initial Quantity" 
                    name="initial_quantity" 
                    :value="$medicine->initial_quantity"
                    :min="$medicine->consumed_quantity"
                    placeholder="100"
                    step="1"
                    required
                />

                <!-- User/Memorandum Receipt -->
                <x-inventory.select
                    label="Memorandum Receipt"
                    name="user_id"
                    :options="$users->pluck('full_name', 'id')->toArray()"
                    :selected="$medicine->box->user_id"
                    required
                />
            </x-inventory.form>
        </x-inventory.modal>
    @endforeach
@endsection
