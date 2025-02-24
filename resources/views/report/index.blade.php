@extends('layouts.app-layout')

@section('content')
<div class="container px-4 mx-auto">
    <h5 class="text-4xl font-bold mt-14">Reports</h5>

    <div class="flex flex-wrap items-center justify-end w-full gap-4 mb-5">
        <!-- Add Button -->
        <button class="px-3 py-2 text-white bg-green-500 rounded-md hover:bg-green-600" 
                onclick="openModal()">
            Add Report
        </button>

        <div class="relative">
    <button id="filterButton" class="w-full px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600" onclick="toggleDropdown()"> 
        Filter by Category
    </button>

    <ul id="filterDropdown" class="absolute z-50 hidden w-full mt-1 bg-white border rounded-md shadow-lg">
        <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('report.index') }}">All</a></li>
        <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('report.index', ['category' => 'students']) }}">Students</a></li>
        <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('report.index', ['category' => 'faculty']) }}">Faculty</a></li>
        <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('report.index', ['category' => 'admin']) }}">Admin</a></li>
        <li><a class="block px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200" href="{{ route('report.index', ['category' => 'visitors']) }}">Visitors</a></li>
    </ul>
</div>

    </div>

    <!-- Responsive Table -->
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
                        <button onclick="openEditModal({{ $report }})" class="px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                        </svg>
                    </button>
                    <form action="{{ route('report.destroy', $report->id) }}" method="POST">
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

    <!-- Pagination -->
    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>

<!-- Add Report Modal -->
<div id="addReportModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[1500em] max-w-auto max-w-4xl mx-4 sm:mx-auto overflow-y-auto max-h-[80vh] relative"> 
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute text-xl font-bold text-red-600 top-4 right-4">
            ✖
        </button>

        <h5 class="mb-4 text-xl font-bold text-center">Add New Report</h5>
        
        <form id="addReportForm" action="{{ route('report.store') }}" method="POST" class="space-y-4">
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
                <textarea id="diagnosis" name="diagnosis" class="w-full p-3 border rounded-md" required></textarea>
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
                    <option value="admin">Admin</option>
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
function openModal() { document.getElementById('addReportModal').classList.remove('hidden'); }
function closeModal() { document.getElementById('addReportModal').classList.add('hidden'); }
function toggleDropdown() { document.getElementById('filterDropdown').classList.toggle('hidden'); }
</script>
@endsection
