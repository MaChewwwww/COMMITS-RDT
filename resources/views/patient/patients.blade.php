@extends('layouts.app-layout')

@section('title', 'Patients Records')

@section('content')
    <div class="mx-auto">
        <x-page-title class="mb-2" value="Patients Records" class="mb-0"/>
        <p class="text-sm text-gray-500 mb-7">A list of all patient records.</p>

        <div class="flex flex-wrap items-center justify-end w-full gap-4 mb-3">

            <!-- Add Button -->
            <button type="button"
                class="inline-flex items-center gap-2 px-6 py-2.5 text-white bg-blue-500 hover:bg-blue-600 rounded-lg
            transition-all duration-200 shadow-md hover:shadow-lg active:shadow-sm transform hover:-translate-y-0.5 active:translate-y-0"
                data-bs-toggle="modal" data-bs-target="#addPatientModal">
                <span class="font-medium">+ Add Patient</span>
            </button>
        </div>

        <div class="bg-white p-4 shadow rounded-lg">
            <div class="flex items-center justify-between">
                <!-- Tab Navigation -->
                <nav class="flex -mb-px space-x-3 overflow-x-auto" aria-label="Tabs">
                    <!-- Tab buttons for filtering patients -->
                    <button type="button"
                        class="px-4 py-2 text-base rounded text-gray-800 border-b-2 rounded-t border-blue-500 bg-blue-50 tab-btn whitespace-nowrap active hover:text-gray-700"
                        data-filter="all">
                        All Patients
                    </button>
                    <button type="button"
                        class="text-base text-gray-500 px-4 py-2 border-b-2 border-gray-300 rounded cursor-pointer tab-btn whitespace-nowrap hover:text-gray-700"
                        data-filter="Student">
                        Students
                    </button>
                    <button type="button"
                        class="text-base text-gray-500 px-4 py-2 border-b-2 border-gray-300 rounded cursor-pointer tab-btn whitespace-nowrap hover:text-gray-700"
                        data-filter="Faculty">
                        Faculty
                    </button>
                    <button type="button"
                        class="text-base text-gray-500 px-4 py-2 border-b-2 border-gray-300 rounded cursor-pointer tab-btn whitespace-nowrap hover:text-gray-700"
                        data-filter="Admin">
                        Administrative
                    </button>
                    <button type="button"
                        class="text-base text-gray-500 px-4 py-2 border-b-2 border-gray-300 rounded cursor-pointer tab-btn whitespace-nowrap hover:text-gray-700"
                        data-filter="Visitor">
                        Visitors
                    </button>
                    <button type="button"
                        class="text-base text-gray-500 px-4 py-2 border-b-2 border-gray-300 rounded cursor-pointer tab-btn whitespace-nowrap hover:text-gray-700"
                        data-filter="Dependent">
                        Dependents
                    </button>
                </nav>

                <!-- Search bar -->
                <div>
                    <input type="text" placeholder="Search for patients..."
                        class="w-64 h-10 p-3 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                        id="patient_search" autocomplete="off" onkeyup="" />
                </div>
            </div>

            <!-- Table Container -->
            <div class="mt-4">
                <div class="overflow-x-auto shadow-sm rounded-lg">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-100">
                                <!-- Table headers -->
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Printed
                                            Name</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Sex</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Patient
                                            Type</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Year &
                                            Course</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Contact
                                            Number</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-bold tracking-wide text-gray-600 uppercase">Physician</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Patient
                                            Status</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left group">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-bold tracking-wide text-gray-600 uppercase">Actions</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($patients as $patient)
                                <tr class="transition-colors duration-200 hover:bg-gray-50"
                                    data-patient-type="{{ $patient->patientType }}">
                                    <!-- Patient details -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $patient->fullname }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex rounded-full px-2 text-xs font-semibold leading-5
                                            {{ $patient->sex == 'Male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                            {{ $patient->sex }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $patient->patientType }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $patient->year_course_dept }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $patient->contactDetails }}
                                    </td>
                                    <!-- Update the physician cell in your table -->
                                    <td class="px-6 py-4 text-sm text-gray-500"> Dr.
                                        @if ($patient->physician)
                                            {{ $patient->physician->first_name }} {{ $patient->physician->last_name }}
                                        @else
                                            <span class="text-gray-400">Not assigned</span>
                                        @endif
                                    <td class="px-6 py-4 text-sm text-gray-500"> {{ $patient->patient_status }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        <div class="flex items-center gap-x-4">
                                            <button
                                                class="px-3 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-900"
                                                data-bs-toggle="modal" data-bs-target="#viewPatient-{{ $patient->id }}"
                                                data-patient-id="{{ $patient->id }}" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                class="px-3 py-2 text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-900"
                                                data-bs-toggle="modal"
                                                data-bs-target="#prescriptionListModal-{{ $patient->id }}"
                                                data-patient-id="{{ $patient->id }}" title="View">
                                                <i class="fas fa-prescription"></i>
                                            </button>
                                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                                class="inline-block" onsubmit="return false;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(this.form)"
                                                    class="px-3 py-2 text-white transition-colors duration-200 bg-red-600 rounded-lg hover:bg-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Prescription List Modal -->
                                <div class="modal fade" id="prescriptionListModal-{{ $patient->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="overflow-hidden border-0 shadow-lg modal-content rounded-xl">
                                            <!-- Modal Header with Close Button -->
                                            <div class="relative p-6 border-b border-gray-200">
                                                <div class="text-center">
                                                    <h5 class="text-xl font-semibold text-gray-900">Prescription
                                                        History</h5>
                                                    <p class="text-sm text-gray-500">{{ $patient->fullname }}</p>
                                                </div>
                                                <button type="button"
                                                    class="absolute text-gray-400 top-4 right-4 hover:text-gray-500 focus:outline-none"
                                                    data-bs-dismiss="modal">
                                                    <i class="text-xl fas fa-times"></i>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="p-6">
                                                <!-- Prescriptions List -->
                                                <div class="overflow-y-auto max-h-[400px]">
                                                    @if ($patient->prescriptionMedicines->count() > 0)
                                                        @foreach ($patient->prescriptionMedicines as $prescription)
                                                            <div
                                                                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                                                                <div class="flex items-center justify-between mb-2">
                                                                    <div class="flex items-center gap-x-2">
                                                                        <span class="text-sm font-medium text-gray-900">
                                                                            @if ($prescription->medicine)
                                                                                {{ $prescription->medicine->medicine_name }}
                                                                            @else
                                                                                <span class="text-gray-400">Medicine
                                                                                    unavailable</span>
                                                                            @endif
                                                                        </span>
                                                                        <span
                                                                            class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                                                            {{ $prescription->quantity }} units
                                                                        </span>
                                                                    </div>
                                                                    <span class="text-xs text-gray-500">
                                                                        {{ $prescription->created_at->format('M d, Y') }}
                                                                    </span>
                                                                </div>
                                                                @if ($prescription->medicine)
                                                                    <p class="text-sm text-gray-600">
                                                                        Available:
                                                                        {{ $prescription->medicine->remaining_quantity }}
                                                                        {{ $prescription->medicine->unit }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="py-8 text-center">
                                                            <div class="mb-4 text-gray-400">
                                                                <i class="text-4xl fas fa-prescription-bottle"></i>
                                                            </div>
                                                            <h3 class="text-lg font-medium text-gray-900">No
                                                                prescriptions yet</h3>
                                                            <p class="mt-1 text-sm text-gray-500">
                                                                Create a new prescription using the button below.
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Create Prescription Button -->
                                                <div class="flex justify-center pt-6 mt-6 border-t border-gray-200">
                                                    <button type="button"
                                                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-200"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#prescriptionModal-{{ $patient->id }}"
                                                        onclick="$('#prescriptionListModal-{{ $patient->id }}').modal('hide')">
                                                        <i class="mr-2 fas fa-plus-circle"></i>
                                                        Create New Prescription
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add this after your existing modals -->
                                <div class="modal fade" id="prescriptionModal-{{ $patient->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="overflow-hidden border-0 shadow-lg modal-content rounded-xl">
                                            <div class="p-6 modal-body">
                                                <form action="{{ route('prescriptions.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                                                    <!-- Modal Header -->
                                                    <div class="relative pb-5 mb-6 border-b border-gray-200">
                                                        <div class="text-center">
                                                            <h5 class="text-xl font-semibold text-gray-900">Create New
                                                                Prescription</h5>
                                                            <p class="text-sm text-gray-500">For patient:
                                                                {{ $patient->fullname }}</p>
                                                        </div>
                                                        <button type="button"
                                                            class="absolute top-0 right-0 text-gray-400 hover:text-gray-500 focus:outline-none"
                                                            data-bs-dismiss="modal">
                                                            <i class="text-xl fas fa-times"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Medicine Selection -->
                                                    <div class="space-y-4">
                                                        <div class="flex items-center gap-4">
                                                            <div class="flex-1">
                                                                <label for="medicine-select-{{ $patient->id }}"
                                                                    class="block mb-1 text-sm font-medium text-gray-700">
                                                                    Select Medicine <span class="text-red-500"> *</span>
                                                                </label>
                                                                <select id="medicine-select-{{ $patient->id }}"
                                                                    name="medicine_id"
                                                                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition-all"
                                                                    required>
                                                                    <option value="">Select a medicine</option>
                                                                    @foreach ($medicines as $medicine)
                                                                        <option value="{{ $medicine->id }}"
                                                                            data-remaining="{{ $medicine->remaining_quantity }}"
                                                                            data-unit="{{ $medicine->unit }}">
                                                                            {{ $medicine->medicine_name }} (Available:
                                                                            {{ $medicine->remaining_quantity }}
                                                                            {{ $medicine->unit }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="w-32">
                                                                <label for="quantity-{{ $patient->id }}"
                                                                    class="block mb-1 text-sm font-medium text-gray-700">
                                                                    Quantity <span class="text-red-500"> *</span>
                                                                </label>
                                                                <input type="number" id="quantity-{{ $patient->id }}"
                                                                    name="quantity"
                                                                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition-all"
                                                                    min="1" placeholder="Qty" disabled required
                                                                    oninput="this.value = this.value > this.max ? this.max : Math.abs(this.value)">
                                                                <span class="text-xs text-gray-500"
                                                                    id="quantity-help-{{ $patient->id }}"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Action Buttons -->
                                                    <div class="flex justify-end gap-3 mt-6">
                                                        <button type="button"
                                                            class="px-6 py-2.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 focus:ring focus:ring-gray-200 transition-all"
                                                            data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                        <button type="submit"
                                                            class="px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 focus:ring focus:ring-green-200 transition-all">
                                                            Save Prescription
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Patient Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="overflow-hidden border-0 shadow-lg modal-content rounded-xl">
                <div class="p-0 modal-body">
                    <form id="addPatientForm" action="{{ route('patients.store') }}" method="POST" class="p-6">
                        @csrf
                        <!-- Add alert for validation errors -->
                        <div class="mb-4 alert alert-danger d-none" id="addErrorAlert"></div>

                        <!-- Form Title -->
                        <div class="mb-6 text-center">
                            <h5 class="text-xl font-semibold text-gray-900">New Patient</h5>
                            <p class="text-sm text-gray-500">Enter patient information below</p>
                        </div>

                        <div class="space-y-4">
                            <!-- Personal Info -->
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <div class="flex"><x-input-label value="First Name " /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="firstName"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="First Name" required>
                                </div>
                                <div>
                                    <x-input-label class="mb-1" value="Middle Name " />
                                    <input type="text" name="middleName"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Middle Name">
                                </div>
                                <div>
                                    <div class="flex"><x-input-label value="Last Name " /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="lastName"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="flex"><x-input-label value="Sex " /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <select name="sex"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        required>
                                        <option value="" selected>Select sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="flex"><x-input-label value="Contact Number " /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="tel" name="contactDetails"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Contact Number" pattern="[0-9]{11}"
                                        title="Please enter a valid 11-digit phone number" required>
                                </div>
                            </div>

                            <!-- Classification -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="flex"><x-input-label value="Patient Type" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <select name="patientType"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        required>
                                        <option value="" selected>Select patient type</option>
                                        <option value="Student">Student</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Admin">Administrative</option>
                                        <option value="Visitor">Visitor</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="flex"><x-input-label value="Year/Course/Dept" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="year_course_dept"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Year/Course/Dept">
                                </div>
                                <div class="col-span-2">
                                    <div class="flex"><x-input-label value="Student Number" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="student_number"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Enter student number">
                                </div>
                            </div>

                            <!-- Medical Info -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="flex"><x-input-label value="Patient Status" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <input type="text" name="patient_status"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        placeholder="Enter patient status" required>
                                </div>
                                <div>
                                    <div class="flex"><x-input-label value="Physician" /><span
                                            class="text-red-500 ml-1">*</span></div>
                                    <select name="physician_id"
                                        class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                        required>
                                        <option value="" selected>Select a physician</option>
                                        @foreach ($physicians ?? [] as $physician)
                                            <option value="{{ $physician->id }}">
                                                {{ $physician->first_name }} {{ $physician->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 pt-4">
                                <button type="submit"
                                    class="flex-1 px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg
                                hover:bg-green-700 focus:ring focus:ring-red-200 transition-all">
                                    <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                    Save Patient
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

    @foreach ($patients as $patient)
        <div class="modal fade" id="viewPatient-{{ $patient->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="overflow-hidden border-0 shadow-lg modal-content rounded-xl">
                    <div class="p-0 modal-body">
                        <form id="patientForm-{{ $patient->id }}" action="{{ route('patients.update', $patient->id) }}"
                            method="POST" class="p-6">
                            @csrf
                            @method('PUT')

                            <!-- Form Title -->
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h5 class="text-xl font-semibold text-gray-900">Patient Information</h5>
                                    <p class="text-sm text-gray-500">View or modify patient details</p>
                                </div>
                                <button type="button"
                                    class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-lg
                                hover:bg-yellow-200 focus:ring focus:ring-yellow-200 transition-all"
                                    onClick="toggleEdit({{ $patient->id }})">
                                    <i class="fas fa-edit me-1"></i>
                                    <span>Edit</span>
                                </button>
                            </div>

                            <!-- Add alert for validation errors -->
                            <div class="mb-4 alert alert-danger d-none" id="errorAlert-{{ $patient->id }}"></div>

                            <div class="space-y-4">
                                <!-- Personal Info -->
                                <div class="grid grid-cols-3 gap-2">
                                    <div>
                                        <div class="flex"><x-input-label value="First Name" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <input type="text" name="firstName"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            value="{{ $patient->firstName }}" placeholder="First Name" disabled required>
                                    </div>
                                    <div>
                                        <div class="flex mb-1"><x-input-label value="Middle Name" /></div>
                                        <input type="text" name="middleName"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            value="{{ $patient->middleName }}" placeholder="Middle Name" disabled>
                                    </div>
                                    <div>
                                        <div class="flex"><x-input-label value="Last Name" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <input type="text" name="lastName"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            value="{{ $patient->lastName }}" placeholder="Last Name" disabled required>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="flex"><x-input-label value="Sex" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <select name="sex"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            disabled required>
                                            <option value="Male" {{ $patient->sex == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $patient->sex == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                    <div>
                                        <div class="flex"><x-input-label value="Contact Number" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <input type="tel" name="contactDetails"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            value="{{ $patient->contactDetails }}" placeholder="Contact Number *"
                                            disabled required>
                                    </div>
                                </div>

                                <!-- Classification -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="flex"><x-input-label value="Patient Type" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <select name="patientType"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            disabled required>
                                            <option value="Student"
                                                {{ $patient->patientType == 'Student' ? 'selected' : '' }}>Student</option>
                                            <option value="Faculty"
                                                {{ $patient->patientType == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                                            <option value="Admin"
                                                {{ $patient->patientType == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Visitor"
                                                {{ $patient->patientType == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                                            <option value="Dependent"
                                                {{ $patient->patientType == 'Dependent' ? 'selected' : '' }}>Dependent
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <div class="flex"><x-input-label value="Year/Course/Dept" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <input type="text" name="year_course_dept"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            value="{{ $patient->year_course_dept }}" placeholder="Year/Course/Dept"
                                            disabled>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="flex"><x-input-label value="Student Number" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <input type="text" name="student_number"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            value="{{ $patient->student_number }}" placeholder="Student Number" disabled>
                                    </div>
                                </div>

                                <!-- Medical Info -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="flex"><x-input-label value="Patient Status" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <input type="text" name="patient_status"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            placeholder="Patient Status *" value="{{ $patient->patient_status }}"
                                            disabled required>
                                    </div>
                                    <div>
                                        <div class="flex"><x-input-label value="Physician" /><span
                                                class="text-red-500 ml-1">*</span></div>
                                        <select name="physician_id"
                                            class="w-full px-2 py-2.5 text-sm rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                            disabled>
                                            @foreach ($physicians ?? [] as $physician)
                                                <option value="{{ $physician->id }}"
                                                    {{ $patient->physician_id == $physician->id ? 'selected' : '' }}>
                                                    {{ $physician->first_name }} {{ $physician->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3 pt-4">
                                    <button type="submit"
                                        class="flex-1 px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg
                                    hover:bg-green-700 focus:ring focus:ring-red-200 transition-all"
                                        disabled>
                                        <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                        Save Changes
                                    </button>
                                    <button type="button"
                                        class="px-6 py-2.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg
                                    hover:bg-gray-200 focus:ring focus:ring-gray-200 transition-all"
                                        data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('styles')
    <style>
        .content-wrapper {
            margin-left: 16rem;
            /* 256px - matches sidebar width */
            margin-top: 4rem;
            /* 64px - matches header height */
            min-height: calc(100vh - 4rem);
            background-color: #f1f5f9;
        }

        @media (max-width: 640px) {
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
@endpush

@section('scripts')
    <script>
        // Existing patient form functionality
        function toggleEdit(patientID) {
            const patientForm = document.getElementById('patientForm-' + patientID);
            const patientInputs = patientForm.querySelectorAll('input:not([type="hidden"]), select, textarea');
            const editButton = patientForm.querySelector('button[onClick*="toggleEdit"]');
            const submitBtn = patientForm.querySelector('button[type="submit"]');
            const errorAlert = document.getElementById('errorAlert-' + patientID);

            patientInputs.forEach(input => {
                input.disabled = !input.disabled;
                if (!input.disabled) {
                    input.classList.remove('is-invalid');
                }
            });

            // Reset error alert
            errorAlert.classList.add('d-none');
            errorAlert.textContent = '';

            // Toggle button text and styles
            const buttonIcon = editButton.querySelector('i');
            const buttonText = editButton.querySelector('span');

            if (buttonText.textContent === 'Edit') {
                buttonText.textContent = 'Cancel';
                buttonIcon.classList.remove('fa-edit');
                buttonIcon.classList.add('fa-times');
                editButton.classList.remove('bg-yellow-100', 'text-yellow-700');
                editButton.classList.add('bg-gray-100', 'text-gray-700');
                submitBtn.disabled = false; // Enable submit button
            } else {
                buttonText.textContent = 'Edit';
                buttonIcon.classList.remove('fa-times');
                buttonIcon.classList.add('fa-edit');
                editButton.classList.remove('bg-gray-100', 'text-gray-700');
                editButton.classList.add('bg-yellow-100', 'text-yellow-700');
                submitBtn.disabled = true; // Disable submit button
                patientForm.reset(); // Reset form to original values
            }
        }

        // Form submission handlers
        document.querySelectorAll('[id^="patientForm-"]').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const spinner = submitBtn.querySelector('.spinner-border');
                const errorAlert = document.getElementById('errorAlert-' + this.id.split('-')[1]);
                const modal = this.closest('.modal');

                // Reset previous errors
                errorAlert.classList.add('d-none');
                errorAlert.innerHTML = '';

                // Remove previous validation classes
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                // Show loading state
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');

                try {
                    const formData = new FormData(this);

                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        const data = await response.json();
                        console.log('Response data:', data); // Log response data for debugging

                        if (data.success) {
                            // Hide modal
                            bootstrap.Modal.getInstance(modal).hide();

                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            // Show validation errors
                            errorAlert.classList.remove('d-none');

                            // Display the main error message
                            const errorHeader = document.createElement('div');
                            errorHeader.className = 'font-medium text-red-600 mb-2';
                            errorHeader.textContent = data.message ||
                                'Please correct the following errors:';
                            errorAlert.appendChild(errorHeader);

                            if (data.errors) {
                                const errorList = document.createElement('ul');
                                errorList.className = 'list-disc pl-5 text-sm';

                                Object.entries(data.errors).forEach(([field, errors]) => {
                                    const input = this.querySelector(`[name="${field}"]`);
                                    if (input) {
                                        input.classList.add('is-invalid');

                                        // Add error message below input
                                        const feedback = document.createElement('div');
                                        feedback.className = 'text-red-500 text-xs mt-1';
                                        feedback.textContent = errors[0];
                                        input.parentNode.appendChild(feedback);
                                    }

                                    // Add to error list
                                    const li = document.createElement('li');
                                    li.className = 'text-red-500';
                                    li.textContent = errors[0];
                                    errorList.appendChild(li);
                                });

                                errorAlert.appendChild(errorList);
                            }

                            // Show error toast
                            Swal.fire({
                                icon: 'error',
                                title: 'Form Error',
                                text: data.message || 'Please check the form for errors.',
                                confirmButtonColor: '#9F1239'
                            });
                        }
                    } else {
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while saving changes.',
                        confirmButtonColor: '#9F1239'
                    });
                } finally {
                    // Reset loading state
                    submitBtn.disabled = false;
                    spinner.classList.add('d-none');
                }
            });
        });

        // Add patient form handler
        document.getElementById('addPatientForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const spinner = submitBtn.querySelector('.spinner-border');
            const errorAlert = document.getElementById('addErrorAlert');
            const modal = this.closest('.modal');

            // Reset previous errors
            errorAlert.classList.add('d-none');
            errorAlert.innerHTML = '';

            // Remove previous validation classes
            this.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });

            // Remove previous error messages
            this.querySelectorAll('.text-red-500').forEach(el => {
                el.remove();
            });

            // Show loading state
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Hide modal
                    bootstrap.Modal.getInstance(modal).hide();

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message || 'Patient added successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    // Show validation errors
                    errorAlert.classList.remove('d-none');

                    // Display the main error message
                    const errorHeader = document.createElement('div');
                    errorHeader.className = 'font-medium text-red-600 mb-2';
                    errorHeader.textContent = data.message || 'Please correct the following errors:';
                    errorAlert.appendChild(errorHeader);

                    if (data.errors) {
                        const errorList = document.createElement('ul');
                        errorList.className = 'list-disc pl-5 text-sm';

                        Object.entries(data.errors).forEach(([field, errors]) => {
                            const input = this.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                input.classList.add('border-red-500');

                                // Add error message below input
                                const feedback = document.createElement('div');
                                feedback.className = 'text-red-500 text-xs mt-1';
                                feedback.textContent = errors[0];
                                input.parentNode.appendChild(feedback);
                            }

                            // Add to error list
                            const li = document.createElement('li');
                            li.className = 'text-red-500';
                            li.textContent = errors[0];
                            errorList.appendChild(li);
                        });

                        errorAlert.appendChild(errorList);
                    }

                    // Scroll to the top of the modal where errors are displayed
                    modal.scrollTop = 0;
                }
            } catch (error) {
                console.error('Error:', error);
                errorAlert.classList.remove('d-none');
                errorAlert.innerHTML =
                    `<div class="font-medium text-red-600">An error occurred. Please try again later.</div>`;

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while adding the patient.',
                    confirmButtonColor: '#9F1239'
                });
            } finally {
                // Reset loading state
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
            }
        });

        // Student number field toggle functionality
        function toggleStudentNumberField(selectElement, formType) {
            const formId = formType === 'add' ? 'addPatientForm' : selectElement.closest('form').id;
            const studentNumberInput = document.querySelector(`#${formId} [name="student_number"]`);
            const studentNumberDiv = studentNumberInput.closest('.col-span-2');

            if (selectElement.value === 'Student') {
                studentNumberDiv.classList.remove('d-none');
                studentNumberInput.required = true;
                if (studentNumberInput.dataset.tempValue) {
                    studentNumberInput.value = studentNumberInput.dataset.tempValue;
                }
            } else {
                studentNumberInput.dataset.tempValue = studentNumberInput.value;
                studentNumberDiv.classList.add('d-none');
                studentNumberInput.required = false;
                studentNumberInput.value = '';
            }
        }

        // Delete confirmation
        function confirmDelete(form) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#9F1239',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Initialize all functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Tab filtering
            const tabButtons = document.querySelectorAll('.tab-btn');
            const patientRows = document.querySelectorAll('tr[data-patient-type]');

            function filterPatients(filterValue) {
                patientRows.forEach(row => {
                    if (filterValue === 'all' || row.dataset.patientType === filterValue) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            }

            // Tab button handlers
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-blue-500', 'text-gray-800',
                            'bg-blue-50');
                        btn.classList.add('border-gray-300', 'text-gray-500');
                    });
                    button.classList.remove('border-gray-300', 'text-gray-500');
                    button.classList.add('border-blue-500', 'text-gray-800', 'bg-blue-50');
                    filterPatients(button.dataset.filter);
                });
            });

            // Prescription form handlers
            const prescriptionForms = document.querySelectorAll('form[action*="prescriptions"]');
            prescriptionForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    handlePrescriptionSubmit(form);
                });
            });

            // Medicine selection handlers
            const medicineSelects = document.querySelectorAll('select[id^="medicine-select-"]');
            medicineSelects.forEach(select => {
                select.addEventListener('change', function() {
                    handleMedicineSelection(this);
                });
            });

            // Initialize student number fields
            document.querySelector('#addPatientForm [name="patientType"]')?.addEventListener('change', function() {
                toggleStudentNumberField(this, 'add');
            });

            document.querySelectorAll('[id^="patientForm-"] [name="patientType"]').forEach(select => {
                select.addEventListener('change', function() {
                    toggleStudentNumberField(this, 'edit');
                });
            });
        });

        // Helper function for prescription submission
        async function handlePrescriptionSubmit(form) {
            try {
                // Remove previous error messages
                form.querySelectorAll('.text-red-500').forEach(el => {
                    el.remove();
                });

                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Update medicine quantities in dropdowns
                    if (data.medicine) {
                        updateMedicineQuantities(
                            data.medicine.id,
                            data.medicine.remaining_quantity,
                            data.medicine.unit
                        );
                    }

                    // Close modal and show success message
                    const patientId = formData.get('patient_id');
                    bootstrap.Modal.getInstance(document.querySelector(`#prescriptionModal-${patientId}`)).hide();

                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#dc2626'
                    }).then(() => {
                        // Update prescriptions list if needed
                        const prescriptionsList = document.querySelector(
                            `#prescriptionListModal-${patientId} .overflow-y-auto`);
                        if (prescriptionsList) {
                            const newPrescription = createPrescriptionElement(data.prescription);
                            prescriptionsList.insertAdjacentHTML('afterbegin', newPrescription);
                        }

                        // Reset form
                        form.reset();
                    });
                } else {
                    // Display specific error message
                    let errorMessage = data.message || 'An error occurred while creating the prescription.';

                    // Handle validation errors
                    if (data.errors) {
                        // Create error messages under inputs
                        Object.entries(data.errors).forEach(([field, errors]) => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('border-red-500');

                                // Add error message below input
                                const feedback = document.createElement('div');
                                feedback.className = 'text-red-500 text-xs mt-1';
                                feedback.textContent = errors[0];
                                input.parentNode.appendChild(feedback);
                            }
                        });
                    }

                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while creating the prescription. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#dc2626'
                });
            }
        }

        // Function to update medicine quantities in all dropdowns
        function updateMedicineQuantities(medicineId, newQuantity, unit) {
            // Get all medicine select elements
            const medicineSelects = document.querySelectorAll('select[id^="medicine-select-"]');

            medicineSelects.forEach(select => {
                // Find the option with the matching medicine ID
                const option = select.querySelector(`option[value="${medicineId}"]`);
                if (option) {
                    const medicineName = option.textContent.split('(')[0].trim();
                    option.textContent = `${medicineName} (Available: ${newQuantity} ${unit})`;

                    // If this option is currently selected, update the quantity input max value
                    if (option.selected) {
                        const patientId = select.id.split('-').pop();
                        const quantityInput = document.getElementById(`quantity-${patientId}`);
                        if (quantityInput) {
                            quantityInput.max = newQuantity;
                            // If current value is greater than new max, update it
                            if (parseInt(quantityInput.value) > newQuantity) {
                                quantityInput.value = newQuantity;
                            }
                        }
                    }
                }
            });
        }

        // Helper function for medicine selection
        function handleMedicineSelection(select) {
            const patientId = select.id.split('-').pop();
            const quantityInput = document.getElementById(`quantity-${patientId}`);
            const selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                const availableQty = selectedOption.text.match(/Available: (\d+)/);
                if (availableQty && availableQty[1]) {
                    quantityInput.max = availableQty[1];
                    quantityInput.value = '';
                    quantityInput.disabled = false;
                }
            } else {
                quantityInput.disabled = true;
                quantityInput.value = '';
                quantityInput.removeAttribute('max');
            }
        }

        // Prescription element creator
        function createPrescriptionElement(prescription) {
            return `
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
            <div class="flex flex-col space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-x-2">
                        <span class="text-sm font-medium text-gray-900">
                            ${prescription.medicine.medicine_name}
                        </span>
                        <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                            ${prescription.quantity} units
                        </span>
                    </div>
                    <span class="text-xs text-gray-500">
                        ${new Date(prescription.created_at).toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        })}
                    </span>
                </div>
                <div class="pt-2 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        Available: ${prescription.medicine.remaining_quantity} ${prescription.medicine.unit}
                    </p>
                </div>
            </div>
        </div>
    `;
        }
    </script>
@endsection
