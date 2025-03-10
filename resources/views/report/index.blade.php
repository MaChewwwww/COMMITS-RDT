@extends('layouts.app-layout')

@section('content')
    <div class="container mx-auto">
        <x-page-title class="mb-2" value="Reports" />

        <div class="flex flex-wrap items-center justify-end w-full gap-2 mb-3">
            <div class="relative">
                <button id="filterButton" class="w-full px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600"
                    onclick="toggleDropdown()">
                    Filter by Category
                </button>

                <ul id="filterDropdown" class="absolute z-50 hidden w-full mt-1 bg-white border rounded-md shadow-lg">
                    <li><a class="block px-4 py-2 font-normal text-gray-700 hover:bg-gray-200"
                            href="{{ route('report.index') }}">All</a></li>
                    <li><a class="block px-4 py-2 font-normal text-gray-700 hover:bg-gray-200"
                            href="{{ route('report.index', ['category' => 'students']) }}">Students</a></li>
                    <li><a class="block px-4 py-2 font-normal text-gray-700 hover:bg-gray-200"
                            href="{{ route('report.index', ['category' => 'faculty']) }}">Faculty</a></li>
                    <li><a class="block px-4 py-2 font-normal text-gray-700 hover:bg-gray-200"
                            href="{{ route('report.index', ['category' => 'admin']) }}">Admin</a></li>
                    <li><a class="block px-4 py-2 font-normal text-gray-700 hover:bg-gray-200"
                            href="{{ route('report.index', ['category' => 'visitors']) }}">Visitors</a></li>
                </ul>
            </div>

            <!-- Add Button -->
            <button type="button"
                class="inline-flex items-center gap-2 px-6 py-2.5 text-white bg-blue-500 hover:bg-blue-600 rounded-lg
            transition-all duration-200 shadow-md hover:shadow-lg active:shadow-sm transform hover:-translate-y-0.5 active:translate-y-0"
                data-bs-toggle="modal" data-bs-target="#addReportModal">
                <span class="font-medium">+ Add Report</span>
            </button>
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
                                <button onclick="openEditModal({{ $report }})"
                                    class="px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </button>
                                <form action="{{ route('report.destroy', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                clip-rule="evenodd" />
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
    <div class="modal fade" id="addReportModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="overflow-hidden border-0 shadow-lg modal-content rounded-xl">
                <div class="p-0 modal-body">
                    <form id="addReportForm" action="{{ route('report.store') }}" method="POST" class="p-6">
                        @csrf
                        <!-- Add alert for validation errors -->
                        <div class="mb-4 alert alert-danger d-none" id="addErrorAlert"></div>

                        <!-- Form Title -->
                        <div class="mb-6 text-center">
                            <h5 class="text-xl font-semibold text-gray-900">New Report</h5>
                            <p class="text-sm text-gray-500">Enter report information below</p>
                        </div>

                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Title" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="title"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Enter title of report" required>
                                </div>
                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Patient's Name" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="name"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Enter patient's full name" required>
                                </div>
                                <div>
                                    <div class="flex"><x-input-label value="Sex" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <select name="sex"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        required>
                                        <option selected>Select biological sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="flex"><x-input-label value="Age" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="number" name="age"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Enter patient's age" title="Please enter a valid number" required>
                                </div>
                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Category" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <select name="category"
                                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        required>
                                        <option selected>Select category</option>
                                        <option value="Student">Student</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Admin">Administrative</option>
                                        <option value="Visitor">Visitor</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>

                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Complaint Reason" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <textarea type="text" name="complaint"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Type complaint reason here"></textarea>
                                </div>

                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Diagnosis" class="mb-1 ml-1" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <textarea type="text" name="diagnosis"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Type complaint reason here"></textarea>
                                </div>

                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Remarks" class="mb-1 ml-1" /></div>
                                    <textarea type="text" name="remarks"
                                        class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Type complaint reason here"></textarea>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 pt-4">
                                <button type="submit"
                                    class="flex-1 px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg
                                hover:bg-green-700 focus:ring focus:ring-green-200 transition-all">
                                    <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                    Save Report
                                </button>
                                <button type="button"
                                    class="px-6 py-2.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg
                                hover:bg-gray-200 focus:ring focus:ring-gray-200 transition-all"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('addReportModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addReportModal').classList.add('hidden');
        }

        function toggleDropdown() {
            document.getElementById('filterDropdown').classList.toggle('hidden');
        }
    </script>
@endsection
