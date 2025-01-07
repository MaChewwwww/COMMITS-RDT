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
    <header class="mb-5 px-16">
        <!-- Title Section -->
        <div>
            <h1 class="text-2xl font-bold mb-2">History</h1>
        </div>

        <!-- Filter Button Section -->
        <div class="relative inline-block text-left w-full">
            <div class="flex justify-between items-center">
                <p class="text-lg font-semibold">Student's</p>

                <!-- Filter Button -->
                <button
                    class="dropdown-button bg-yellow-400 text-white px-4 py-2 rounded-md hover:bg-yellow-500 flex items-center">
                    <p class="mr-2">Filter</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                        <path
                            d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                            fill="#FFFFFF" />
                    </svg>
                </button>
            </div>

            <!-- Dropdown Content -->
            <div class="dropdown-content hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-48">
                <a href="/all" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">All</a>
                <a href="/student" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Student</a>
                <a href="/faculty" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Faculty</a>
                <a href="/visitor" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Visitor</a>
                <a href="/dependent" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dependent</a>
            </div>
        </div>
    </header>
        <div class="container mx-auto bg-white rounded-lg shadow-lg p-5">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Date</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Time</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Printed Name</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Sex</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Student Number</th>
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
