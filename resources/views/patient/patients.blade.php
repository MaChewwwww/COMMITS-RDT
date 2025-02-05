@extends('layouts.app-layout')

@section('content')

<div class="p-4 m-4">
    <!-- Add Patient Button -->
    <a href="{{ route('patients.add') }}"
        class="inline-block px-4 py-2 mb-4 text-white bg-blue-500 rounded-md hover:bg-blue-600">
        Add New Patient
    </a>

    <!-- Patients Table -->
    <table class="min-w-full mt-4 border border-collapse border-gray-300">
        <thead>
            <tr>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Date</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Time</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Printed Name
                </th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Sex</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Course - Yr
                    & Sect./Dept</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Treatment /
                    Medicine</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Qty</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Phyiscian
                </th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Status</th>
                <th class="px-4 py-2 font-medium text-left text-gray-600 bg-gray-100 border border-gray-300">Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->created_at->format('H:i A') }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->fullname }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->sex }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->year_course_dept }}</td>
                    <td class="px-4 py-2 border border-gray-300">Lorem Ipsum</td>
                    <td class="px-4 py-2 border border-gray-300">Lorem Ipsum</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->user_id }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $patient->patient_status }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        <!-- Edit Button -->
                        <a href="{{ route('patients.edit', $patient->id) }}"
                            class="mr-2 text-blue-500 hover:text-blue-700">Edit</a> |
                        <!-- Delete Button -->
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this patient?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
