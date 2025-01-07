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
        <div class="w-full p-6 bg-white shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Add Patient</h2>
            <form method="POST" action="{{ route('patients.store') }}" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="fullname" name="fullname" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Sex -->
                <div>
                    <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                    <select id="sex" name="sex" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <!-- Year, Course, and Department -->
                <div>
                    <label for="year_course_dept" class="block text-sm font-medium text-gray-700">Year, Course, Department</label>
                    <input type="text" id="year_course_dept" name="year_course_dept" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Contact Details -->
                <div>
                    <label for="contactDetails" class="block text-sm font-medium text-gray-700">Contact Details</label>
                    <input type="text" id="contactDetails" name="contactDetails" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Patient Status -->
                <div>
                    <label for="patient_status" class="block text-sm font-medium text-gray-700">Patient Status</label>
                    <input type="text" id="patient_status" name="patient_status" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Patient Type -->
                <div>
                    <label for="patientType" class="block text-sm font-medium text-gray-700">Patient Type</label>
                    <select id="patientType" name="patientType" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="Student">Student</option>
                        <option value="Faculty">Faculty</option>
                        <option value="Admin">Admin</option>
                        <option value="Visitor">Visitor</option>
                        <option value="Dependent">Dependent</option>
                    </select>
                </div>

                <!-- Student Number -->
                <div>
                    <label for="student_number" class="block text-sm font-medium text-gray-700">Student Number</label>
                    <input type="text" id="student_number" name="student_number" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                </div>

                <!-- User ID -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">User ID (Optional)</label>
                    <input type="number" id="user_id" name="user_id" class="mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Script to handle enabling/disabling of student_number based on Patient Type -->
        <script>
            // Function to enable or disable the student_number field based on Patient Type
            function toggleStudentNumber() {
                const patientType = document.getElementById('patientType').value;
                const studentNumberInput = document.getElementById('student_number');

                if (patientType === 'Student') {
                    studentNumberInput.disabled = false; // Enable student number input
                } else {
                    studentNumberInput.disabled = true; // Disable student number input
                    studentNumberInput.value = ""; // Clear the input value when disabled
                }
            }

            // Initial call to set the correct state when the page loads
            toggleStudentNumber();

            // Add event listener for changes to the Patient Type dropdown
            document.getElementById('patientType').addEventListener('change', toggleStudentNumber);
        </script>
    </body>



</html>
