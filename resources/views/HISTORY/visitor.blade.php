<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Record Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-5 font-sans">
    <header>
        <h2 class="font-medium text-xl text-gray-600 mb-5">History</h2>
    </header>


    <!-- Filter Button -->
    <div class="flex justify-between items-center mb-5">
        <p class="text-lg font-semibold">Visitor's</p>
        <div class="relative">
            <button class="dropdown-button bg-yellow-400 text-[#7A0019] py-2 px-4 rounded-lg flex items-center gap-2 text-sm">
                Filter
                <span class="w-3 h-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="6" viewBox="0 0 11 6" fill="none">
                        <path d="M5.51919 5.51543L0.0390625 1.37889L1.86576 0L5.51919 2.75774L9.17254 0L10.9992 1.37889L5.51919 5.51543Z" fill="#7A0019"/>
                    </svg>
                </span>
            </button>
            <div class="dropdown-content hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-48">
                <a href="/all" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">All</a>
                <a href="/student" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Student</a>
                <a href="/faculty" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Faculty</a>
                <a href="/visitor" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Visitor</a>
                <a href="/dependent" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dependent</a>
            </div>
        </div>
    </div>
        <div class="container mx-auto bg-white rounded-lg shadow-lg p-5">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Date</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Time</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Printed Name</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Sex</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Course-Yr & Sect./Dept</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Treatment Medicine</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Quantity</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Physician</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Lorem</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        document.querySelector('.dropdown-button').addEventListener('click', function() {
            document.querySelector('.dropdown-content').classList.toggle('hidden');
        });
    </script>
</body>
</html>
