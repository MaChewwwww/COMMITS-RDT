@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="create-inventory-supplies" >
    <x-inventory.form method="POST" action="{{ route('add_supply_store') }}">

        <!-- date_received -->

        <!-- expiration_date -->

        <!-- supply_name -->

        <!-- stock_number -->

        <!-- unit_of_measurement-->

        <!-- initial_quantity -->

        <!-- user_id / memorandum_receipt -->

        <!-- 
            SUPPLIES
            - Alocohol 1 gal
            - Gauze Bandage
            - Betadine 120ml
            - Face Mask

            UNITS
            - Piece
            - Bottle
            - Gallon
            - Strip
            - Box
            - Pair
            - Pack
        -->

        <x-inventory.input
            label="Supply Name" 
            name="supply_name" 
            placeholder="Betadine 120ml"
            required
        />

    </x-inventory.form>
</x-inventory.modal>
@endsection

@section('inventory-table')
    Supplies Table
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
@endsection