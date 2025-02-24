@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="edit-inventory-supplies">
    <x-inventory.form method="POST" action="{{ route('update_supply', $supply->id) }}">
        @method('PUT')
        
        <!-- date_received -->
        <x-inventory.date
            label="Date Received" 
            name="date_received" 
            value="{{ old('date_received', \Carbon\Carbon::parse($supply->box->date_received)->format('Y-m-d')) }}"
            required
        />

        <!-- expiration_date -->
        <x-inventory.date
            label="Expiration Date" 
            name="expiration_date" 
            value="{{ old('expiration_date', \Carbon\Carbon::parse($supply->expiration_date)->format('Y-m-d')) }}"
            required
        />

        <!-- supply_name -->
        <x-inventory.input
            label="Supply Name" 
            name="supply_name" 
            value="{{ old('supply_name', $supply->supply_name) }}"
            placeholder="Gauze Bandage"
            required
        />

        <!-- stock_number -->
        <x-inventory.input
            label="Stock #" 
            name="stock_number" 
            value="{{ old('stock_number', $supply->box->stock_number) }}"
            placeholder="##-###"
            required
        />

        <!-- unit -->
        <x-inventory.input
            label="Unit_of_measurement" 
            name="unit_of_measurement" 
            value="{{ old('unit_of_measurement', $supply->unit) }}"
            placeholder="Piece"
            required
        />

        <!-- initial_quantity -->
        <x-inventory.quantity
            label="Initial Quantity"
            name="initial_quantity"
            value="{{ old('initial_quantity', $supply->initial_quantity) }}"
            :min="$supply->consumed_quantity"
            step="1"
            placeholder="100"
            required
        />

        <!-- user_id / memorandum_receipt -->
        <x-inventory.select
            label="MOR" 
            name="user_id" 
            :selected="$supply->box->user_id"
            :options="$users->pluck('full_name', 'id')->toArray()"
            required
        />
    </x-inventory.form>
</x-inventory.modal>
@endsection