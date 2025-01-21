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
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mb-2">History</h1>
            <div class="relative">
                <form method="GET" action="{{ route('HISTORY.all') }}">
                    <button
                        type="button"
                        class="dropdown-button bg-yellow-400 text-white px-4 py-2 rounded-md hover:bg-yellow-500 flex items-center"
                        onclick="toggleDropdown()">
                        <p class="mr-2">Filter</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                            <path
                                d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                                fill="#FFFFFF" />
                        </svg>
                    </button>
        
                    <div id="dropdown-content" class="dropdown-content hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-64 p-4">
                        <label for="identity" class="block text-gray-700 mb-2">Identity:</label>
                        <select
                            name="identity"
                            id="identity"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md mb-4">
                            <option value="">All Identities</option>
                            <option value="Student" {{ $identityFilter == 'Student' ? 'selected' : '' }}>Student</option>
                            <option value="Faculty" {{ $identityFilter == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                            <option value="Admin" {{ $identityFilter == 'Dependent' ? 'selected' : '' }}>Dependent</option>
                            <option value="Admin" {{ $identityFilter == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                        </select>
        
                        <label for="month" class="block text-gray-700 mb-2">Filter by Month:</label>
                        <select
                            name="month"
                            id="month"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md mb-4">
                            <option value="">All Months</option>
                            @foreach($months as $month)
                            <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                            @endforeach
                        </select>
        
                        <button
                            type="submit"
                            class="bg-yellow-400 text-white px-4 py-2 rounded-md hover:bg-yellow-500 w-full">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <div class="container mx-auto bg-white rounded-lg shadow-lg p-5">
        @if($records->isEmpty())
            <p>No Records Found</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Start Date</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Discharge Date</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Printed Name</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Sex</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Identity</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Physician</th>
                        <th class="py-2 px-4 text-left text-sm text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 px-4">{{ $record->start_date }}</td>
                            <td class="py-2 px-4">{{ $record->discharge_date }}</td>
                            <td class="py-2 px-4">{{ $record->patient_name }}</td>
                            <td class="py-2 px-4">{{ $record->sex }}</td>
                            <td class="py-2 px-4">{{ $record->identity }}</td>
                            <td class="py-2 px-4">{{ $record->physician }}</td>
                            <td class="py-2 px-4">{{ $record->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-content');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>
</html>
