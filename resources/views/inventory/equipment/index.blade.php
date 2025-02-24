@extends('layouts.inventory')

@section('inventory-add')
<x-inventory.modal target="create-inventory-equipment" >
    <x-inventory.form method="POST" action="{{ route('equipment.store') }}">
        @csrf
        <x-inventory.input
            label="General Description" 
            name="general_description" 
            placeholder="Enter description"
            required
        />

        <x-inventory.select
            label="MOR" 
            name="user_id" 
            :options="$users->pluck('full_name', 'id')->toArray()"
            required
        />

        <x-inventory.quantity
            label="Quantity"
            name="quantity"
            :min="0"
            placeholder="1"
            required
        />

        <x-inventory.quantity
            label="Quantity of Request"
            name="quantity_of_request"
            :min="0"
            placeholder="1"
            required
        />

        <x-inventory.equipment-checklist>
            <x-inventory.equipment-checkbox
                name="serviceable"
                label="Serviceable"
            />
            <x-inventory.equipment-checkbox
                name="for_repair"
                label="For Repair"
            />
            <x-inventory.equipment-checkbox
                name="for_condemn"
                label="For Condemn"
            />
            <x-inventory.equipment-checkbox
                name="need_replacement"
                label="Need Replacement"
            />
            <x-inventory.equipment-checkbox
                name="additional"
                label="Additional"
            />
        </x-inventory.equipment-checklist>
    </x-inventory.form>
</x-inventory.modal>
@endsection

@section('inventory-table')
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

        <!-- CONTENT -->
        <x-inventory.table-body :data="$equipment" :users="$users">
            @foreach ($equipment as $item)
                <x-inventory.table-row>
                    <x-inventory.table-cell>{{ $item->general_description }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ number_format($item->quantity) }}</x-inventory.table-cell>
                    <x-inventory.table-cell class="text-center">
                        @if($item->serviceable)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mx-auto size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @endif
                    </x-inventory.table-cell>
                    <x-inventory.table-cell class="text-center">
                        @if($item->for_repair)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mx-auto size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @endif
                    </x-inventory.table-cell>
                    <x-inventory.table-cell class="text-center">
                        @if($item->for_condemn)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mx-auto size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @endif
                    </x-inventory.table-cell>
                    <x-inventory.table-cell class="text-center">
                        @if($item->need_replacement)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mx-auto size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @endif
                    </x-inventory.table-cell>
                    <x-inventory.table-cell class="text-center">
                        @if($item->additional)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mx-auto size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @endif
                    </x-inventory.table-cell>
                    <x-inventory.table-cell>{{ number_format($item->quantity_of_request) }}</x-inventory.table-cell>
                    <x-inventory.table-cell>{{ $item->user->full_name }}</x-inventory.table-cell>
                    <x-inventory.table-cell>
                        <div class="flex justify-center gap-2">
                            <x-inventory.btn-edit-modal heading="Edit a Record" target="{{ 'edit-'.$item->id }}">
                                <x-inventory.form method="POST" action="{{ route('update_equipment', $item->id) }}">
                                    @method('PUT')
                                    @csrf
                                    
                                    <x-inventory.input
                                        label="General Description" 
                                        name="general_description" 
                                        value="{{ old('general_description', $item->general_description) }}"
                                        placeholder="Enter description"
                                        required
                                    />

                                    <x-inventory.select
                                        label="MOR" 
                                        name="user_id" 
                                        :options="$users->pluck('full_name', 'id')->toArray()"
                                        :selected="$item->user_id"
                                        required
                                    />

                                    <x-inventory.quantity
                                        label="Quantity"
                                        name="quantity"
                                        value="{{ old('quantity', $item->quantity) }}"
                                        :min="0"
                                        placeholder="1"
                                        required
                                    />

                                    <x-inventory.quantity
                                        label="Quantity of Request"
                                        name="quantity_of_request"
                                        value="{{ old('quantity_of_request', $item->quantity_of_request) }}"
                                        :min="0"
                                        placeholder="1"
                                        required
                                    />

                                    <x-inventory.equipment-checklist>
                                        <x-inventory.equipment-checkbox
                                            name="serviceable"
                                            label="Serviceable"
                                            :checked="old('serviceable', $item->serviceable)"
                                        />
                                        <x-inventory.equipment-checkbox
                                            name="for_repair"
                                            label="For Repair"
                                            :checked="old('for_repair', $item->for_repair)"
                                        />
                                        <x-inventory.equipment-checkbox
                                            name="for_condemn"
                                            label="For Condemn"
                                            :checked="old('for_condemn', $item->for_condemn)"
                                        />
                                        <x-inventory.equipment-checkbox
                                            name="need_replacement"
                                            label="Need Replacement"
                                            :checked="old('need_replacement', $item->need_replacement)"
                                        />
                                        <x-inventory.equipment-checkbox
                                            name="additional"
                                            label="Additional"
                                            :checked="old('additional', $item->additional)"
                                        />
                                    </x-inventory.equipment-checklist>
                                </x-inventory.form>
                            </x-inventory.btn-edit-modal>
                            <x-inventory.btn-delete target="{{ 'delete-'.$item->id }}" />
                            <x-inventory.confirm-deletion 
                                target="{{ 'delete-'.$item->id }}" 
                                action="{{ route('delete_equipment', $item->id) }}"
                            />
                        </div>
                    </x-inventory.table-cell>
                </x-inventory.table-row>
            @endforeach
        </x-inventory.table-body>
    </x-inventory.table>

    {{ $equipment->links() }}
@endsection