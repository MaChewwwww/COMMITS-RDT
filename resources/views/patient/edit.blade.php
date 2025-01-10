<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!-- Button container -->
        <div class="p-4 m-4">
            <h1 class="mb-4 text-2xl font-semibold">Edit Patient</h1>

            <!-- Form to Edit Patient Details -->
            <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT') <!-- HTTP PUT Method for updating -->

                <!-- Full Name -->
                <div class="flex flex-col">
                    <label for="fullname" class="font-medium text-gray-700">Full Name</label>
                    <input type="text" name="fullname" id="fullname" value="{{ old('fullname', $patient->fullname) }}" class="border border-gray-300 p-2 rounded-md @error('fullname') border-red-500 @enderror">
                    @error('fullname')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sex -->
                <div class="flex flex-col">
                    <label for="sex" class="font-medium text-gray-700">Sex</label>
                    <select name="sex" id="sex" class="border border-gray-300 p-2 rounded-md @error('sex') border-red-500 @enderror">
                        <option value="Male" {{ old('sex', $patient->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex', $patient->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('sex')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Year/Course/Dept -->
                <div class="flex flex-col">
                    <label for="year_course_dept" class="font-medium text-gray-700">Year/Course/Dept</label>
                    <input type="text" name="year_course_dept" id="year_course_dept" value="{{ old('year_course_dept', $patient->year_course_dept) }}" class="border border-gray-300 p-2 rounded-md @error('year_course_dept') border-red-500 @enderror">
                    @error('year_course_dept')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Details -->
                <div class="flex flex-col">
                    <label for="contactDetails" class="font-medium text-gray-700">Contact Details</label>
                    <input type="text" name="contactDetails" id="contactDetails" value="{{ old('contactDetails', $patient->contactDetails) }}" class="border border-gray-300 p-2 rounded-md @error('contactDetails') border-red-500 @enderror">
                    @error('contactDetails')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Patient Status -->
                <div class="flex flex-col">
                    <label for="patient_status" class="font-medium text-gray-700">Patient Status</label>
                    <input type="text" name="patient_status" id="patient_status" value="{{ old('patient_status', $patient->patient_status) }}" class="border border-gray-300 p-2 rounded-md @error('patient_status') border-red-500 @enderror">
                    @error('patient_status')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Patient Type -->
                <div class="flex flex-col">
                    <label for="patientType" class="font-medium text-gray-700">Patient Type</label>
                    <select name="patientType" id="patientType" class="border border-gray-300 p-2 rounded-md @error('patientType') border-red-500 @enderror">
                        <option value="Student" {{ old('patientType', $patient->patientType) == 'Student' ? 'selected' : '' }}>Student</option>
                        <option value="Faculty" {{ old('patientType', $patient->patientType) == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                        <option value="Admin" {{ old('patientType', $patient->patientType) == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Visitor" {{ old('patientType', $patient->patientType) == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                        <option value="Dependent" {{ old('patientType', $patient->patientType) == 'Dependent' ? 'selected' : '' }}>Dependent</option>
                    </select>
                    @error('patientType')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Number -->
                <div class="flex flex-col">
                    <label for="student_number" class="block text-sm font-medium text-gray-700">Student Number</label>
                    <input type="text" id="student_number" name="student_number" class="p-2 mt-1 border rounded" value="{{ $patient->student_number }}">
                </div>

                <!-- User ID -->
                <div class="flex flex-col">
                    <label for="user_id" class="font-medium text-gray-700">User ID (Optional)</label>
                    <input type="number" name="user_id" id="user_id" value="{{ old('user_id', $patient->user_id) }}" class="border border-gray-300 p-2 rounded-md @error('user_id') border-red-500 @enderror">
                    @error('user_id')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Update Patient</button>
                </div>
            </form>
        </div>

        <script>
            function toggleStudentNumber() {
                const patientType = document.getElementById('patientType').value;
                const studentNumberInput = document.getElementById('student_number');

                if (patientType === 'Student') {
                    studentNumberInput.disabled = false; // Enable student number input
                    studentNumberInput.value = "{{ $patient->student_number  }}"
                } else {
                    studentNumberInput.disabled = true; // Disable student number input
                    studentNumberInput.value = ""; // Clear the input value when disabled
                }
            }

            toggleStudentNumber();

            document.getElementById('patientType').addEventListener('change', toggleStudentNumber);
        </script>
    </body>


</html>
