@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Medicine List</h1>
        <a href="{{ route('add_medicine') }}" class="btn btn-primary">Add New Medicine</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Box ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Initial Quantity</th>
                    <th>Consumed Quantity</th>
                    <th>Remaining Quantity</th>
                    <th>Unit of Measurement</th>
                    <th>Expiration Date</th>
                    <th>Box Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->box_id }}</td>
                    <td>{{ $medicine->medicine_name }}</td>
                    <td>{{ $medicine->description }}</td>
                    <td>{{ $medicine->initial_quantity }}</td>
                    <td>{{ $medicine->consumed_quantity }}</td>
                    <td>{{ $medicine->remaining_quantity }}</td>
                    <td>{{ $medicine->unit_of_measurement }}</td>
                    <td>{{ $medicine->expiration_date }}</td>
                    <td>{{ $medicine->box->status }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger me-2" data-bs-toggle="modal" data-bs-target="#deductModal{{ $medicine->id }}">
                            Deduct Stock
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="deductModal{{ $medicine->id }}" tabindex="-1" aria-labelledby="deductModalLabel{{ $medicine->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border-danger">
                                    <form action="{{ route('deduct_medicine', $medicine->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-white modal-header bg-danger">
                                            <h5 class="modal-title" id="deductModalLabel{{ $medicine->id }}">Deduct Stock for {{ $medicine->medicine_name }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Quantity to Deduct</label>
                                                <input type="number" class="form-control border-danger" id="quantity" name="quantity" min="1" max="{{ $medicine->remaining_quantity }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Confirm Deduction</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('edit_medicine', $medicine->id) }}" class="btn btn-sm btn-warning">Edit</a>
          
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">No medicines found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection