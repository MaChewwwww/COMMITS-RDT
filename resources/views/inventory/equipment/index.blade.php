@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="create-inventory-equipment" >
    <x-inventory.form method="POST" action="{{ route('add_equipment_store') }}">

        <!-- general_desc-->
            <!-- 
                - Hospital bed with mattress
                - Bedsheets and pillow cases
                - Wheelchair
                - Computer
                - Printer
                - Air Purifier
                - Office Chairs
            -->
        <div class="col-span-2">
            <x-inventory.input
                label="General Description" 
                name="equipment_name" 
                placeholder="Stretcher, folding"
                required
            />
        </div>

        <!-- initial_quantity -->
        <x-inventory.quantity
            label="Quantity"
            name="initial_quantity"
            :min=0
            placeholder="5"
            required
        />

        <!-- request_quantity -->
        <x-inventory.quantity
            label="Quantity of Request"
            name="request_quantity"
            :min=0
            placeholder="3"
        />

        <!-- check if the ff: -->
        <x-inventory.equipment-checklist>
            <x-inventory.equipment-list
                label="Serviceable"
                name="serviceable"
            />
            
            <x-inventory.equipment-list
                label="For Repair"
                name="for_repair"
            />
            <x-inventory.equipment-list
                label="For Condemn"
                name="for_condemn"
            />

            <x-inventory.equipment-list
                label="Need Replacement"
                name="need_replacement"
            />
            
            <x-inventory.equipment-list
                label="Additional"
                name="additional"
            />
        </x-inventory.equipment-checklist>

        <!-- user_id / memorandum_receipt -->
        {{-- <x-inventory.select
                label="MOR" 
                name="user_id" 
                :options="$users->pluck('first_name', 'id')->toArray()"
                required
        /> --}}
    
    </x-inventory.form>
</x-inventory.modal>
@endsection

@section('inventory-table')
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

    <x-inventory.table>
        <!-- HEADER  -->
        <x-inventory.table-head
            :headers="[
                'General Description',
                'Quantity',
                'Serviceable',
                'For Repair',
                'For Condemn',
                'Need Replacement',
                'Additional',
                'Quantity of Request',
                'MOR',
                'Actions'
            ]" 
        />

        
        <!-- CHECK MARK DRAFT-->
        {{-- <tr class="bg-white border-b  hover:bg-gray-100"">
            <td class="px-6 py-4 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </td>
        </tr> --}}

        <!-- CONTENT -->
        {{-- <x-inventory.table-body :data="$equipments" :users="$users">
            @foreach ($equipments as $equipment)
                <x-inventory.table-row>
                    <x-inventory.table-cell>{{ $equipment->equipment_name }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $equipment->initial_quantity }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ if $equipment->serviceable return check mark }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ if $equipment->for_repair return check mark}}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ if $equipment->for_condemn return check mark}}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ if $equipment->need_replacement return check mark}}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ if $equipment->additional return check mark}}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $equipment->request_quantity }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $equipment->box->user->first_name }}</x-inventory.table-cell>
                    <x-inventory.table-cell>
                        <div class="flex justify-center gap-2">
                            <!-- Edit Button -->
                            <x-inventory.btn-edit-modal heading="Edit a Record" target="{{ 'edit-'.$equipment->id }}" >  
                                <x-inventory.form method="POST" action="{{ route('update_equipment', $equipment->id) }}">
                                    @method('PUT')
                                    
                                    <!-- general_desc-->
                                    <div class="col-span-2">
                                        <x-inventory.input
                                            label="General Description" 
                                            name="equipment_name" 
                                            value={{ old("equipment_name", $equipment->equipment_name) }}
                                            placeholder="Stretcher, folding"
                                            required
                                        />
                                    </div>
                            
                                    <!-- initial_quantity -->
                                    <x-inventory.quantity
                                        label="Quantity"
                                        name="initial_quantity"
                                        value={{ old("initial_quantity", $equipment->initial_quantity) }}
                                        :min=0
                                        placeholder="5"
                                        required
                                    />
                            
                                    <!-- request_quantity -->
                                    <x-inventory.quantity
                                        label="Quantity of Request"
                                        name="request_quantity"
                                        value={{ old("request_quantity", $equipment->request_quantity) }}
                                        :min=0
                                        placeholder="3"
                                    />
                            
                                    <!-- check if the ff: -->
                                    <x-inventory.equipment-checklist>
                                        <x-inventory.equipment-list
                                            label="Serviceable"
                                            name="serviceable"
                                            :value="$equipment->serviceable"
                                        />
                                        
                                        <x-inventory.equipment-list
                                            label="For Repair"
                                            name="for_repair"
                                            :value="$equipment->for_repair"
                                        />
                                        <x-inventory.equipment-list
                                            label="For Condemn"
                                            name="for_condemn"
                                            :value="$equipment->for_condemn"
                                        />
                            
                                        <x-inventory.equipment-list
                                            label="Need Replacement"
                                            name="need_replacement"
                                            :value="$equipment->need_replacement"
                                        />
                                        
                                        <x-inventory.equipment-list
                                            label="Additional"
                                            name="additional"
                                            :value="$equipment->additional"
                                        />
                
                                    <!-- user_id / memorandum_receipt -->
                                    <x-inventory.select
                                        label="MOR" 
                                        name="user_id" 
                                        :selected="$supply->box->user_id"
                                        :options="$users->pluck('first_name', 'id')->toArray()"
                                        required
                                    />
                                </x-inventory.form>
                            </x-inventory.btn-edit-modal> 
                
                            <!-- Delete Button -->
                            <x-inventory.btn-delete target="{{'delete-'.$equipment->id}}" />
                            <x-inventory.confirm-deletion target="{{'delete-'.$equipment->id}}" action="{{ route('delete_equipment', $equipment->id) }}"/>
                        </div>
                    </x-inventory.table-cell>
                </x-inventory.table-row>
            @endforeach
        </x-inventory.table-body> --}}
    </x-inventory.table>

    {{-- {{ $equipments->links() }} --}}
@endsection