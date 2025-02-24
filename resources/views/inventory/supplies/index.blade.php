@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="create-inventory-supplies">
    <x-inventory.form method="POST" action="{{ route('supplies.store') }}">
        <!-- date_received -->
        <x-inventory.date
            label="Date Received" 
            name="date_received" 
            required
        />

        <!-- expiration_date -->
        <x-inventory.date
            label="Expiration Date" 
            name="expiration_date" 
            required
        />

        <!-- supply_name -->
        <x-inventory.input
            label="Supply Name" 
            name="supply_name" 
            placeholder="Gauze Bandage"
            required
        />

        <!-- stock_number -->
        <x-inventory.input
            label="Stock #" 
            name="stock_number" 
            placeholder="##-###"
            required
        />

        <!-- unit -->
        <x-inventory.input
            label="Unit_of_measurement" 
            name="unit_of_measurement"
            placeholder="Piece" 
            required
        />

        <!-- initial_quantity -->
        <x-inventory.quantity
            label="Initial Quantity"
            name="initial_quantity"
            min="1"
            step="1"
            placeholder="100"
            required
        />

        <!-- user_id / memorandum_receipt -->
        <x-inventory.select
            label="MOR" 
            name="user_id" 
            :options="$users->pluck('full_name', 'id')->toArray()"
            required
        />
    </x-inventory.form>
</x-inventory.modal>
@endsection

@section('inventory-table')
    <!-- 
        HEADERS 
        - Date Received
        - Stock #
        - Supply (Name)
        - Unit (Measurement)
        - Quantity (Initial)
        - Consumed (Nullable)
        - Balance
        - Expiry Date (Nullable)
        - Memorandum Receipt (User)

        ROW ACTIONS
        - Info (Mobile screen, View Toggle)
        - Edit (Modal Form, Confirm Dialog before Update)
        - Delete (Soft)
        - Deduct (?)
    -->

    <x-inventory.table>
        <!-- HEADER  -->
        <x-inventory.table-head
            :headers="[
                'Date Received',
                'Stock #',
                'Supply',
                'Unit',
                'Initial Quantity',
                'Consumed',
                'Balance',
                'Expiration Date',
                'MOR',
                'Actions'
            ]" 
        />

        <!-- CONTENT -->
        <x-inventory.table-body :data="$supplies" :users="$users">
            @foreach ($supplies as $supply)
                <x-inventory.table-row>
                    <x-inventory.table-cell>{{ \Carbon\Carbon::parse($supply->box->date_received)->format('Y-m-d') }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $supply->box->stock_number }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $supply->supply_name }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $supply->unit }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ number_format($supply->initial_quantity)}}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ number_format($supply->consumed_quantity) }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ number_format($supply->remaining_quantity) }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ \Carbon\Carbon::parse($supply->expiration_date)->format("M' y") }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $supply->box->user->full_name }}</x-inventory.table-cell>
                    <x-inventory.table-cell>
                        <div class="flex justify-center gap-2">
                            <x-inventory.btn-edit-modal heading="Edit a Record" target="{{ 'edit-'.$supply->id }}">  
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

                                    <!-- consumed_quantity -->
                                    <x-inventory.quantity
                                        label="Consumed Quantity"
                                        name="consumed_quantity"
                                        value="{{ old('consumed_quantity', $supply->consumed_quantity) }}"
                                        :max="$supply->initial_quantity"
                                        min="0"
                                        step="1"
                                        placeholder="0"
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
                            </x-inventory.btn-edit-modal> 
            
                            <x-inventory.btn-delete target="{{ 'delete-'.$supply->id }}" />
                            <x-inventory.confirm-deletion 
                                target="{{ 'delete-'.$supply->id }}" 
                                action="{{ route('delete_supply', $supply->id) }}"
                            />
                        </div>
                    </x-inventory.table-cell>
                </x-inventory.table-row>
            @endforeach
        </x-inventory.table-body>
    </x-inventory.table>

    {{ $supplies->links() }}
@endsection