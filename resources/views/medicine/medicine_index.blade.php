@extends('layouts.app')
@section('content')

<div class="container flex flex-col gap-10 m-8 mx-auto">
    <h1 class="text-3xl font-semibold">Inventory</h1>

    <!-- Dashboard
    <div class="flex justify-evenly">
        <div class="min-w-[350px] flex flex-col items-center gap-4 p-6 border rounded-2xl shadow-xl">
            <h3 class="text-2xl font-semibold">Medicines</h3>
            <div class="h-[200px] w-[200px]">
                <div class="w-full h-full bg-yellow-500 border rounded-full"></div>
            </div>
            <div class="flex justify-center gap-8">
                <div class="flex items-center gap-2 ">
                    <div class="w-5 h-5 bg-red-600"></div>
                    <p class="label">Nearly Expired</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-lime-600"></div>
                    <p class="label">Remainings</p>
                </div>
            </div>    
        </div>

        <div class="min-w-[350px] flex flex-col items-center gap-4 p-4 border rounded-2xl shadow-xl">
            <h3 class="text-2xl font-semibold">Equipment</h3>
            <div class="h-[200px] w-[200px]">
                <div class="w-full h-full bg-yellow-500 border rounded-full"></div>
            </div>
            <div class="flex justify-center gap-8">
                <div class="flex items-center gap-2 ">
                    <div class="w-5 h-5 bg-red-600"></div>
                    <p class="label">Broken</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-lime-600"></div>
                    <p class="label">Remainings</p>
                </div>
            </div>    
        </div>

        <div class="min-w-[350px] flex flex-col items-center gap-4 p-4 border rounded-2xl shadow-xl">
            <h3 class="text-2xl font-semibold">Medical Supplies</h3>
            <div class="h-[200px] w-[200px]">
                <div class="w-full h-full bg-yellow-500 border rounded-full"></div>
            </div>
            <div class="flex justify-center gap-8">
                <div class="flex items-center gap-2 ">
                    <div class="w-5 h-5 bg-red-600"></div>
                    <p class="label">Consumed</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-lime-600"></div>
                    <p class="label">Remainings</p>
                </div>
            </div>    
        </div>
    </div>-->

    <!-- Chart Section -->
    <div class="flex justify-center mb-4 space-x-4">
        <!-- First Chart -->
        <div class="flex flex-col items-center w-1/3 p-4 bg-white border rounded-lg shadow-md">
            <h5 class="mb-4 text-lg font-semibold">Medicine Stocks</h5>
            <div class="flex items-center justify-center h-64">
                <canvas id="medicineChart"></canvas>
            </div>
        </div>
        <!-- Second Chart -->
        <div class="flex flex-col items-center w-1/3 p-4 bg-white border rounded-lg shadow-md">
            <h5 class="mb-4 text-lg font-semibold">Returned Medicines</h5>
            <div class="flex items-center justify-center h-64">
                <canvas id="returnedChart"></canvas>
            </div>
        </div>
    </div>

    <div class="relative space-y-4 overflow-x-auto">
        <!-- Choice Tabs -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-8 text-xl">
                    <div class="px-8 py-4 border shadow-sm cursor-pointer border-slate-300 rounded-t-xl active:bg-gray-900 active:text-white hover:bg-gray-300">
                        <a href="">Medicines</a>
                    </div>
                    <div class="px-8 py-4 border shadow-sm cursor-pointer border-slate-300 rounded-t-xl active:bg-gray-900 active:text-white hover:bg-gray-300">
                        <a href="">Equipment</a>
                    </div>
                    <div class="px-8 py-4 border shadow-sm cursor-pointer border-slate-300 rounded-t-xl active:bg-gray-900 active:text-white hover:bg-gray-300">
                        <a href="">Medical Supplies</a>
                    </div>
                </div>
                <button id="openModalButton" class="w-28 h-[60px] rounded-lg bg-lime-600 py-2 px-4 mr-8 border border-transparent text-center text-lg font-semibold text-white transition-all shadow-md hover:shadow-lg focus:bg-lime-700 focus:shadow-none active:bg-lime-700 hover:bg-lime-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Add
                </button>
            </div>
            <!-- Dialog with Form -->
            <div>
                <div id="addMedicineModal" class="hidden fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm">
                    <div class="relative mx-auto w-full max-w-[40rem] rounded-lg overflow-hidden shadow-sm bg-white">
                        <button id="closeModalButton" type="button" class="absolute text-xl font-medium text-red-600 top-4 right-4">X</button>
                        <!-- Form -->
                        <form method="POST" action="{{ route('add_medicine_store') }}" class="flex flex-col gap-4 p-12">
                            @csrf
                            <div class="flex justify-between w-full gap-8">
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Date Received
                                    </label>
                                    <input type="date" name="date_received" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" required/>
                                    @error('date_received')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Expiry Date
                                    </label>
                                    <input type="date" name="expiration_date" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" required/>
                                    @error('expiration_date')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-between w-full gap-8">
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Medicine
                                    </label>
                                    <input type="text" name="medicine_name" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" placeholder="Paracetamol 500mg" required/>
                                    @error('medicine_name')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Stock #
                                    </label>
                                    <input type="text" name="stock_number" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" placeholder="##-###" required/>
                                    @error('stock_number')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex gap-8 justify-space-between">
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Unit
                                    </label>
                                    <input type="text" 
                                        name="unit_of_measurement" 
                                        pattern="[A-Za-z\s]+"
                                        title="Please enter letters only"
                                        class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" 
                                        placeholder="Capsule/Tablet" 
                                        required/>
                                    @error('unit_of_measurement')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Quantity
                                    </label>
                                    <input type="number" name="initial_quantity" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" min="1" placeholder="200" required/>
                                    @error('initial_quantity')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-between w-full gap-8">
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Supplier
                                    </label>
                                    <input type="text" name="supplier_name" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-600 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" placeholder="Main Campus" required/>
                                    @error('supplier_name')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full max-w-sm min-w-[200px]">
                                    <label for="user_id" class="block mb-2 text-sm text-slate-600">Memorandum Receipt</label>
                                    <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="self-center w-1/4 px-4 py-2 text-lg text-center text-white transition-all border border-transparent rounded-md shadow-md bg-lime-600 hover:shadow-lg focus:bg-lime-700 focus:shadow-none active:bg-lime-700 hover:bg-lime-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div> <!-- END OF CATEGORY -->

        <!-- Table -->
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date Received
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stock #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Medicine
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Unit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Consumed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Balance
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Expiry Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Supplier
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Memorandum Receipt
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine) 
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ \Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d') }}
                    </th>
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
                        {{ $medicine->box->supplier_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $medicine->box->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <!-- Edit Button -->
                            <button data-dialog-target="edit-dialog-{{ $medicine->id }}" class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                Edit
                            </button>
                            <div class="px-4 py-2 bg-red-500 rounded-lg hover:bg-red-600">
                                <form method="POST" action="{{ route('delete_medicine', $medicine->id) }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white">Delete</button>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Dialog -->
                        <div id="edit-dialog-{{ $medicine->id }}" class="hidden fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm">
                            <div class="relative mx-auto w-full max-w-[40rem] rounded-lg overflow-hidden shadow-sm">
                                <div class="relative flex flex-col bg-white">
                                    <button type="button" data-dialog-close="true" class="self-end mt-8 mr-12 text-xl font-medium text-red-600">X</button>
                                    <!-- Form -->
                                    <form method="POST" action="{{ route('update_medicine', $medicine->id) }}" class="flex flex-col gap-4 p-12">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="flex justify-between w-full gap-8">
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Date Received
                                                </label>
                                                <input type="date" name="date_received" value="{{ old('date_received', \Carbon\Carbon::parse($medicine->box->date_received)->format('Y-m-d')) }}" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" required/>
                                                @error('date_received')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Expiry Date
                                                </label>
                                                <input type="date" name="expiration_date" value="{{ old('expiration_date', \Carbon\Carbon::parse($medicine->expiration_date)->format('Y-m-d')) }}" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" required/>
                                                @error('expiration_date')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between w-full gap-8">
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Medicine
                                                </label>
                                                <input type="text" name="medicine_name" value="{{ old('medicine_name', $medicine->medicine_name) }}" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" placeholder="Paracetamol 500mg" required/>
                                                @error('medicine_name')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Stock #
                                                </label>
                                                <input type="text" name="stock_number" value="{{ old('stock_number', $medicine->box->stock_number) }}" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" placeholder="##-###" required/>
                                                @error('stock_number')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="flex gap-8 justify-space-between">
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Unit
                                                </label>
                                                <input type="text" 
                                                    name="unit_of_measurement" 
                                                    value="{{ old('unit_of_measurement', $medicine->unit) }}" 
                                                    pattern="[A-Za-z\s]+"
                                                    title="Please enter letters only"
                                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" 
                                                    placeholder="Capsule/Tablet" 
                                                    required/>
                                                @error('unit_of_measurement')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Quantity
                                                </label>
                                                <input type="number" 
                                                    name="initial_quantity" 
                                                    value="{{ old('initial_quantity', $medicine->initial_quantity) }}" 
                                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" 
                                                    min="{{ $medicine->consumed_quantity }}" 
                                                    placeholder="200" 
                                                    required/>
                                                @error('initial_quantity')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between w-full gap-8">
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label class="block mb-2 text-sm text-slate-600">
                                                    Supplier
                                                </label>
                                                <input type="text" name="supplier_name" value="{{ old('supplier_name', $medicine->box->supplier_name) }}" class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-600 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" placeholder="Main Campus" required/>
                                                @error('supplier_name')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="w-full max-w-sm min-w-[200px]">
                                                <label for="user_id" class="block mb-2 text-sm text-slate-600">Memorandum Receipt</label>
                                                <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ old('user_id', $medicine->box->user_id) == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button class="self-center w-1/4 px-4 py-2 text-lg text-center text-white transition-all border border-transparent rounded-md shadow-md bg-lime-600 hover:shadow-lg focus:bg-lime-700 focus:shadow-none active:bg-lime-700 hover:bg-lime-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
                                            Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>   
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>


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

<script>
    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('addMedicineModal').classList.remove('hidden');
    });

    document.getElementById('closeModalButton').addEventListener('click', function() {
        document.getElementById('addMedicineModal').classList.add('hidden');
    });
</script>

<script>
    document.querySelectorAll('[data-dialog-target]').forEach(button => {
        button.addEventListener('click', () => {
            const dialogId = button.getAttribute('data-dialog-target');
            document.getElementById(dialogId).classList.remove('hidden');
        });
    });

    document.querySelectorAll('[data-dialog-close]').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('.fixed').classList.add('hidden');
        });
    });
</script>

@endsection