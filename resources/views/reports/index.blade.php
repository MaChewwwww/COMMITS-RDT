@extends('layouts.app-layout')

@section('content')

{{--  gets the filter queries --}}
@php
    $filters = [];

    // Check if a category is selected and add it (capitalize the first letter)
    if(request()->has('category') && request()->query('category') !== ''){
        $filters[] = ucfirst(request()->query('category'));
    }

    // Check if a month is selected; convert the numeric month to its full name
    if(request()->has('month') && request()->query('month') !== ''){
        $monthNumber = (int) request()->query('month');
        // Use DateTime to convert month number to full month name
        $filters[] = DateTime::createFromFormat('!m', $monthNumber)->format('F');
    }

    $filterDisplay = count($filters) ? implode(', ', $filters) : 'None';
@endphp

{{-- notification modal --}}
@if(session('success'))
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="p-6 text-center bg-white rounded shadow-lg">
            <h2 class="mb-4 text-lg font-bold">Success!</h2>
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                    <path fill="#4caf50" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"></path>
                    <path fill="#ccff90" d="M34.602,14.602L21,28.199l-5.602-5.598l-2.797,2.797L21,33.801l16.398-16.402L34.602,14.602z"></path>
                </svg>
            </div>
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif

<div class="container px-4 mx-auto">
    <h5 class="text-4xl font-bold">Reports</h5>

    <div class="flex flex-wrap items-center justify-end w-full gap-4 mb-5">

        @if($filterDisplay !== 'None')
            <p class="items-start flex-grow text-gray-500">
                Filter: {{ $filterDisplay }}
            </p>
        @endif
        
        <!-- Add Button -->
        <button class="px-3 py-2 text-white bg-green-500 rounded-md hover:bg-green-600" 
                onclick="openModal()">
            Add Report
        </button>

        <form action="{{ route('reports.showReportPaper') }}" method="GET">
            <button type="submit" class="px-3 py-2 text-white bg-red-800 rounded-md hover:bg-red-900">
                Print Report Paper
            </button>
        </form>

        {{-- filter by category --}}
        <div class="relative">
            <button id="categoryFilterButton" class="flex items-center w-full gap-2 px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600" onclick="toggleDropdown('categoryFilterDropdown')"> 
                Filter by Category
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                    <path
                        d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                        fill="#FFFFFF" />
                </svg>
            </button>

            <ul id="categoryFilterDropdown" class="absolute z-50 hidden w-full mt-1 bg-white border rounded-md shadow-lg">
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index') }}">All</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(), ['category' => 'students'])) }}">Students</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(), ['category' => 'faculty'])) }}">Faculty</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(), ['category' => 'admin'])) }}">Admin</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(), ['category' => 'visitors'])) }}">Visitors</a></li>
            </ul>
        </div>

        {{-- filter by date --}}
        <div class="relative">
            <button id="dateFilterButton" class="flex items-center w-full gap-2 px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600" onclick="toggleDropdown('dateFilterDropdown')"> 
                Filter by Date
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                    <path
                        d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                        fill="#FFFFFF" />
                </svg>
            </button>

            <ul id="dateFilterDropdown" class="absolute z-50 hidden w-full h-40 mt-1 overflow-y-auto bg-white border rounded-md shadow-lg no-scrollbar">
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index') }}">All</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 1])) }}">January</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 2])) }}">February</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 1])) }}">March</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 2])) }}">April</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 1])) }}">May</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 2])) }}">June</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 1])) }}">July</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 2])) }}">August</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 1])) }}">September</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 2])) }}">October</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 1])) }}">November</a></li>
                <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('reports.index', array_merge(request()->query(),['month' => 2])) }}">December</a></li>
            </ul>
        </div>
    </div>

</div>

    <!-- Responsive Table -->
    @if(count($reports) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-black-500 dark:text-black-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 text-black-700">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Age</th>
                        <th class="px-6 py-3">Sex</th>
                        <th class="px-6 py-3">Complaint/Reason</th>
                        <th class="px-6 py-3">Diagnosis</th>
                        <th class="px-6 py-3">Remarks</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody">
                    @foreach ($reports as $report)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{ $report->title }}</td>
                            <td class="px-6 py-4">{{ $report->name }}</td>
                            <td class="px-6 py-4">{{ $report->age }}</td>
                            <td class="px-6 py-4">{{ $report->sex }}</td>
                            <td class="px-6 py-4">{{ $report->complaint }}</td>
                            <td class="px-6 py-4">{{ $report->diagnosis }}</td>
                            <td class="px-6 py-4">{{ $report->remarks }}</td>
                            <td class="px-6 py-4">{{ $report->category }}</td>
                            <td class="flex px-6 py-4 gap-x-2">
                            <button onclick='openEditModal(@json($report->toArray()))' class="px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>
                        </button>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-8 text-center">
            <p class="text-xl text-gray-600">No reports available.</p>
            <p class="mt-2 text-gray-500">Click on "Add Report" to create your first report.</p>
        </div>
    @endif

    <!-- Pagination -->
    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>

<!-- Add Report Modal -->
<div id="addReportModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[1500em] max-w-auto max-w-4xl mx-4 sm:mx-auto overflow-y-auto max-h-[80vh] relative"> 
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute text-xl font-bold text-red-600 top-4 right-4">
            ✖
        </button>

        <h5 class="mb-4 text-xl font-bold text-center">Add New Report</h5>
        
        <form id="addReportForm" action="{{ route('reports.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-semibold">Title</label>
                <input type="text" id="title" name="title" class="w-full p-3 border rounded-md" required>
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold">Patient's Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 border rounded-md" required>
            </div>

            <div class="flex flex-wrap gap-4">
                <div class="w-full sm:w-1/2">
                    <label for="age" class="block text-sm font-semibold">Age</label>
                    <input type="number" id="age" name="age" class="w-full p-3 border rounded-md" required>
                </div>

                <div class="w-full sm:w-1/2">
                    <label for="sex" class="block text-sm font-semibold">Sex</label>
                    <select id="sex" name="sex" class="w-full p-3 border rounded-md" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="complaint" class="block text-sm font-semibold">Complaint/Reason</label>
                <textarea id="complaint" name="complaint" class="w-full p-3 border rounded-md" required></textarea>
            </div>

            <div>
                <label for="diagnosis" class="block text-sm font-semibold">Diagnosis</label>
                <select id="diagnosis" name="diagnosis" class="w-full p-2.5 border rounded-md" required>
                    <option value="">Select Diagnosis</option>
                    @foreach($services as $service)
                        @if(!$loop->last) {{-- to not include the "Total Online Consult" --}}
                            <option value="{{ $service['name'] }}">{{ $service['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div>
                <label for="remarks" class="block text-sm font-semibold">Remarks</label>
                <textarea id="remarks" name="remarks" class="w-full p-3 border rounded-md"></textarea>
            </div>

            <div>
                <label for="category" class="block text-sm font-semibold">Category</label>
                <select id="category" name="category" class="w-full p-2.5 border rounded-md" required>
                    <option value="students">Students</option>
                    <option value="faculty">Faculty</option>
                    <option value="administrative">Administrative</option>
                    <option value="admin">Dependents</option>
                    <option value="visitors">Visitors</option>
                </select>
            </div>

            <button type="submit" class="w-full p-3 text-white bg-green-500 rounded-md hover:bg-green-600">
                Save
            </button>
        </form>
    </div>
</div>

{{-- edit report modal --}}
<div id="editReportModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[1500em] max-w-auto max-w-4xl mx-4 sm:mx-auto overflow-y-auto max-h-[80vh] relative"> 
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute text-xl font-bold text-red-600 top-4 right-4">
            ✖
        </button>

        <h5 class="mb-4 text-xl font-bold text-center">Edit Report</h5>
        
        <form id="editReportForm" action="{{ route('reports.update', 0) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-semibold">Title</label>
                <input type="text" id="title" name="title" class="w-full p-3 border rounded-md" required>
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold">Patient's Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 border rounded-md" required>
            </div>

            <div class="flex flex-wrap gap-4">
                <div class="w-full sm:w-1/2">
                    <label for="age" class="block text-sm font-semibold">Age</label>
                    <input type="number" id="age" name="age" class="w-full p-3 border rounded-md" required>
                </div>

                <div class="w-full sm:w-1/2">
                    <label for="sex" class="block text-sm font-semibold">Sex</label>
                    <select id="sex" name="sex" class="w-full p-3 border rounded-md" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="complaint" class="block text-sm font-semibold">Complaint/Reason</label>
                <textarea id="complaint" name="complaint" class="w-full p-3 border rounded-md" required></textarea>
            </div>

            <div>
                <label for="diagnosis" class="block text-sm font-semibold">Diagnosis</label>
                <select id="diagnosis" name="diagnosis" class="w-full p-2.5 border rounded-md" required>
                    <option value="">Select Diagnosis</option>
                    @foreach($services as $service)
                        @if(!$loop->last) {{-- to not include the "Total Online Consult" --}}
                            <option value="{{ $service['name'] }}">{{ $service['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div>
                <label for="remarks" class="block text-sm font-semibold">Remarks</label>
                <textarea id="remarks" name="remarks" class="w-full p-3 border rounded-md"></textarea>
            </div>

            <div>
                <label for="category" class="block text-sm font-semibold">Category</label>
                <select id="category" name="category" class="w-full p-2.5 border rounded-md" required>
                    <option value="students">Students</option>
                    <option value="faculty">Faculty</option>
                    <option value="administrative">Administrative</option>
                    <option value="admin">Dependents</option>
                    <option value="visitors">Visitors</option>
                </select>
            </div>

            <button type="submit" class="w-full p-3 text-white bg-green-500 rounded-md hover:bg-green-600">
                Save
            </button>
        </form>
    </div>
</div>

<script>
    function openEditModal(report) {
        console.log(report);
        
        document.getElementById('editReportModal').classList.remove('hidden');
        
        let form = document.getElementById('editReportForm');
        
        form.querySelector('#title').value = report.title;
        form.querySelector('#name').value = report.name;
        form.querySelector('#age').value = report.age;
        form.querySelector('#sex').value = report.sex;
        form.querySelector('#complaint').value = report.complaint;
        form.querySelector('#diagnosis').value = report.diagnosis;
        form.querySelector('#remarks').value = report.remarks;
        form.querySelector('#category').value = report.category;
        
        // Update the form's action to point to the update route
        form.action = '/reports/' + report.id;
        console.log("Form action set to:", form.action);
        
        // Add or update the hidden _method field for PUT requests
        let methodInput = form.querySelector('#formMethod');
        if (methodField) {
            methodField.value = 'PUT';
        }
    }
    function openModal() { 

        document.getElementById('addReportModal').classList.remove('hidden');
        
        // Get the form and reset it for a new report
        const form = document.getElementById('addReportForm');
        form.reset(); // Clear previous data
        
        // Set form action to store route
        form.action = '{{ route("reports.store") }}';
        
        // Remove the _method field if it exists (to ensure it's a POST)
        let methodInput = form.querySelector('#formMethod');
        if (methodInput) {
            methodInput.remove();
        }
    }
    
    function closeModal() { 
        document.getElementById('addReportModal').classList.add('hidden'); 
        document.getElementById('editReportModal').classList.add('hidden'); 
    }
    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    window.onload = function() {
        setTimeout(closeSuccessModal, 2000); // Auto-close after 2 seconds
    }
    function toggleDropdown(dropdownId) {
        const dropdowns = ['categoryFilterDropdown', 'dateFilterDropdown'];
        
        // Hide all dropdowns except the one being toggled
        dropdowns.forEach(id => {
            if (id !== dropdownId) {
                document.getElementById(id).classList.add('hidden');
            }
        });
        
        document.getElementById(dropdownId).classList.toggle('hidden');
    }

    // Hide dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = ['categoryFilterDropdown', 'dateFilterDropdown'];
        dropdowns.forEach(id => {
            const dropdown = document.getElementById(id);
            const button = document.getElementById(id.replace('Dropdown', 'Button'));
            if (dropdown && !dropdown.classList.contains('hidden') && !dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>

@endsection
