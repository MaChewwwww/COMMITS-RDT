<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<<<< Temporary merge branch 1
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome</h1>
</body>
</html>
=========
    <title>Patient Record Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-800">History</h2>
    </header>

    <div class="container mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <p class="text-lg font-semibold"></p>
            <div class="relative">
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg flex items-center focus:outline-none">
                    Filter
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="11" height="6" viewBox="0 0 11 6" fill="none">
                        <path d="M5.51919 5.51543L0.0390625 1.37889L1.86576 0L5.51919 2.75774L9.17254 0L10.9992 1.37889L5.51919 5.51543Z" fill="#fff"/>
                    </svg>
                </button>
                <div class="hidden absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg w-48">
                    <a href="all.html" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">All</a>
                    <a href="Student.html" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Student</a>
                    <a href="Faculty.html" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Faculty</a>
                    <a href="Visitor.html" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Visitor</a>
                    <a href="Dependent.html" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dependent</a>
                </div>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <!-- Your content here -->
    <nav class="p-4 bg-gray-800">
        <div class="container flex items-center justify-between mx-auto">
            <div class="text-lg font-bold text-white">
                <a href="{{ url('/') }}">MyApp</a>
            </div>
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-white">Home</a>
                <a href="{{ url('/about') }}" class="text-gray-300 hover:text-white">About</a>
                <a href="{{ url('/contact') }}" class="text-gray-300 hover:text-white">Contact</a>
            </div>
        </div>

        <table class="w-full border-collapse border border-gray-300 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Time</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Printed Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Sex</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Course-Yr & Sect./Dept</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Treatment Medicine</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Physician</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                    <td class="border border-gray-300 px-4 py-2">Lorem</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        const dropdownButton = document.querySelector('.dropdown button');
        const dropdownContent = document.querySelector('.dropdown-content');

        dropdownButton.addEventListener('click', () => {
            dropdownContent.classList.toggle('hidden');
        });
    </script>
</body>
</html>
>>>>>>>>> Temporary merge branch 2
