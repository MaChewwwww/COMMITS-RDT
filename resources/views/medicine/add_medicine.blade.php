@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Medicine</h5>
                    <a href="{{ route('medicine_dashboard') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('add_medicine_store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="stock_number" class="form-label">Stock Number:</label>
                            <input type="text" 
                                   class="form-control @error('stock_number') is-invalid @enderror" 
                                   id="stock_number" 
                                   name="stock_number" 
                                   value="{{ old('stock_number') }}" 
                                   required>
                            @error('stock_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="medicine_name" class="form-label">Medicine Name:</label>
                            <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" 
                                id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" required>
                            @error('medicine_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="initial_quantity" class="form-label">Initial Quantity:</label>
                            <input type="number" class="form-control @error('initial_quantity') is-invalid @enderror" 
                                id="initial_quantity" name="initial_quantity" value="{{ old('initial_quantity') }}" required>
                            @error('initial_quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit_of_measurement" class="form-label">Unit of Measurement:</label>
                            <input type="text" class="form-control @error('unit_of_measurement') is-invalid @enderror" 
                                id="unit_of_measurement" name="unit_of_measurement" value="{{ old('unit_of_measurement') }}" required>
                            @error('unit_of_measurement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="supplier_name" class="form-label">Supplier Name:</label>
                            <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" 
                                id="supplier_name" name="supplier_name" value="{{ old('supplier_name') }}" required>
                            @error('supplier_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_received" class="form-label">Date Received:</label>
                            <input type="date" class="form-control @error('date_received') is-invalid @enderror" 
                                id="date_received" name="date_received" value="{{ old('date_received', date('Y-m-d')) }}" required>
                            @error('date_received')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Memorandum Receipt</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" 
                                id="user_id" name="user_id" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Expiration Date:</label>
                            <input type="date" class="form-control @error('expiration_date') is-invalid @enderror" 
                                id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}" required>
                            @error('expiration_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Add Medicine</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection