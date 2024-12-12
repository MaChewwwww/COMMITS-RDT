@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Medicine List</h1>
        <a href="{{ route('add_medicine') }}" class="btn btn-primary">Add New Medicine</a>
    </div>

    <!-- Chart Section -->
    <div class="mb-4 row justify-content-center">
        <!-- First Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="text-center card-body">
                    <h5 class="card-title">Medicine Stock Status</h5>
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                        <canvas id="medicineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="text-center card-body">
                    <h5 class="card-title">Returned Medicine Status</h5>
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                        <canvas id="returnedChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>   

    <div class="table-responsive">
        <table class="table align-middle table-striped">
            <thead>
                <tr class="text-center">
                    <th>Date Received</th>
                    <th style="min-width: 120px;">Stock #</th> <!-- Added min-width -->
                    <th class="text-start">Medicine</th>
                    <th>Unit</th>
                    <th class="text-end">Quantity</th>
                    <th class="text-end">Consumed</th>
                    <th class="text-end">Balance</th>
                    <th>Expiry Date</th>
                    <th class="text-start">Supplier</th>
                    <th>Memorandum Receipt</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicines as $medicine)
                <tr>
                    <td class="text-center">{{ \Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d') }}</td>
                    <td class="text-center" style="min-width: 120px;">{{ $medicine->box->stock_number }}</td>
                    <td>{{ $medicine->medicine_name }}</td>
                    <td class="text-center">{{ $medicine->unit_of_measurement }}</td>
                    <td class="text-end">{{ number_format($medicine->initial_quantity) }}</td>
                    <td class="text-end">{{ number_format($medicine->consumed_quantity) }}</td>
                    <td class="text-end">{{ number_format($medicine->remaining_quantity) }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($medicine->expiration_date)->format("M' y") }}</td>
                    <td>{{ $medicine->box->supplier_name }}</td>
                    <td class="text-center">{{ $medicine->box->user->name }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <!-- Deduct Button -->
                            <button type="button" class="btn btn-sm btn-danger me-2" data-bs-toggle="modal" data-bs-target="#deductModal{{ $medicine->id }}">
                                Deduct Stock
                            </button>

                            <!-- Deduct Modal -->
                            <div class="modal fade" id="deductModal{{ $medicine->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content border-danger">
                                        <form action="{{ route('deduct_medicine', $medicine->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="text-white modal-header bg-danger">
                                                <h5 class="modal-title">Deduct Stock for {{ $medicine->medicine_name }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label">Quantity to Deduct</label>
                                                    <input type="number" class="form-control border-danger" 
                                                           id="quantity" name="quantity" 
                                                           min="1" max="{{ $medicine->remaining_quantity }}" required>
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

                            <!-- Edit Button -->
                            <a href="{{ route('edit_medicine', $medicine->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">No medicines found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // First Chart (existing code)
    const ctx = document.getElementById('medicineChart').getContext('2d');
    
    const totalMedicine = {{ $totalMedicine }};
    const expiredMedicine = {{ $expiredMedicine }};
    const nearExpiredMedicine = {{ $nearExpiredMedicine }};
    const goodMedicine = totalMedicine - expiredMedicine - nearExpiredMedicine;
    
    // Calculate percentages
    const expiredPercentage = ((expiredMedicine / totalMedicine) * 100).toFixed(1);
    const nearExpiredPercentage = ((nearExpiredMedicine / totalMedicine) * 100).toFixed(1);
    const goodPercentage = (100 - expiredPercentage - nearExpiredPercentage).toFixed(1);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                `Good Condition (${goodPercentage}%)`,
                `Near Expiry (${nearExpiredPercentage}%)`,
                `Expired (${expiredPercentage}%)`
            ],
            datasets: [{
                data: [goodMedicine, nearExpiredMedicine, expiredMedicine],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        fontSize: 12
                    }
                }
            }
        }
    });

    // Second Chart for Returned Medicines
    const returnedCtx = document.getElementById('returnedChart').getContext('2d');
    
    const returnedMedicines = {{ $returnedMedicines }};
    const notReturnedMedicines = {{ $notReturnedMedicines }};
    const total = returnedMedicines + notReturnedMedicines;
    
    // Calculate percentages
    const returnedPercentage = ((returnedMedicines / total) * 100).toFixed(1);
    const notReturnedPercentage = ((notReturnedMedicines / total) * 100).toFixed(1);

    new Chart(returnedCtx, {
        type: 'pie',
        data: {
            labels: [
                `Returned (${returnedPercentage}%)`,
                `Not Returned (${notReturnedPercentage}%)`
            ],
            datasets: [{
                data: [returnedMedicines, notReturnedMedicines],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        fontSize: 12
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection