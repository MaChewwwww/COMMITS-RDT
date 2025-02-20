@extends('layouts.inventory')
{{--FIELDS
    general_desc, text
    initial_quantity, number
        serviceable?
        nonserviceable?
        for repair?
        for condemn?
        need replacement?
        additional?
    request_quantity, number

--}}
@section('inventory-add')
<x-inventory.modal target="create-inventory-equipment" >
    <x-inventory.form method="POST" action="{{ route('add_equipment_store') }}">

        <!-- general_desc-->
        <!-- initial_quantity -->
        
        <!-- Check if the following: -->
            <!-- serviceable? -->
            <!-- nonserviceable? -->
                <!-- for repair? -->
                <!-- for condemn? -->
                <!-- need replacement? -->
                <!-- additional? -->
            <!-- request_quantity -->

        <x-inventory.input
            label="General Description" 
            name="equipment_name" 
            placeholder="Stretcher, folding"
            required
        />

        <!-- 
            - Hospital bed with mattress
            - Bedsheets and pillow cases
            - Wheelchair
            - Computer
            - Printer
            - Air Purifier
            - Office Chairs
        -->
    </x-inventory.form>
</x-inventory.modal>
@endsection

@section('inventory-table')
    Equipment Table
    <!-- 
        HEADERS 
        - General Description (Name)
        - Quality (Initial)
        
        - Serviceable (?)
        - Nonserviceable (?)
            - For Repair (?)
            - For Condemn (?)
        - Need Replacement (?)
        - Additional (?)

        - Quanitity of Request

        ROW ACTIONS
        - Info (Mobile screen, View Toggle)
        - Edit (Modal Form, Confirm Dialog before Update)
        - Delete (Soft)
        - Deduct (?)
    -->
@endsection