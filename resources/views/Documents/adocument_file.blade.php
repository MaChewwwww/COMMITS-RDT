<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dropdown-content {
            display: none;
        }

        .dropdown-content.show {
            display: block;
        }

        .hover-bg {
            background-color: #f3f4f6; /* light gray for hover */
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-2">Documents</h1>
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-gray-500">Recents</h2>
        <div class="flex space-x-4">
            <!-- Filter Dropdown -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown('filter-dropdown')" class="bg-yellow-400 text-white px-2 py-2 rounded-md hover:bg-yellow-500 flex">
                    <p class="px-2">Filter</p> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                        <path d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z" fill="#FFFFFF"/>
                    </svg>
                </button>
                <div id="filter-dropdown" class="dropdown-content absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg">
                    <a href="{{ route('documents.adocument_file') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All</a>
                    @foreach($typeOptions as $type)
                        <a href="{{ route('documents.adocument_file', ['document_type' => $type]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $type }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Add Dropdown -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown('add-dropdown')" class="bg-green-500 text-white px-2 py-2 rounded-md hover:bg-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 17 17" fill="none">
                        <path d="M7.35714 9.64286H0.5V7.35714H7.35714V0.5H9.64286V7.35714H16.5V9.64286H9.64286V16.5H7.35714V9.64286Z" fill="white"/>
                    </svg>
                    <p class="px-2">Add</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                        <path d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z" fill="#FFFFFF"/>
                    </svg>
                </button>
                <div id="add-dropdown" class="dropdown-content absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded shadow-lg">
                    <a href="{{ route('documents.medical-certificate.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Certificate</a>
                    <a href="{{ route('documents.medical-clearance.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Clearance</a>
                    <a href="{{ route('documents.annual-medical-clearance.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Annual Medical Clearance</a>
                    <a href="{{ route('documents.excuse-letter.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Excuse Letter</a>
                    <a href="{{ route('documents.waiver.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver</a>
                    <a href="{{ route('documents.waiver-for-pulmonary-case.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver for Pulmonary Case</a>
                    <a href="{{ route('documents.dmdc-consent-form.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">DMDC Consent Form</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recents Section -->
    <div class="space-y-4">
        @foreach($documents as $document)
        <div id="document-container" class="bg-white p-4 rounded-lg shadow flex justify-between items-center cursor-pointer transition-all">
            <div>
                <p class="font-medium text-gray-800">{{ $document->document_type }}</p>
                <p class="text-sm text-gray-400">Created on: {{ $document->created_at->format('Y-m-d') }}</p>
            </div>
            <div class="flex space-x-3">
                <!-- Edit Icon -->
                <a href="{{ route('documents.edit', $document->id) }}" class="hover:text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                        <path d="M3 21H8L19.435 9.565L14.435 4.565L3 16V21ZM14.435 4.565L17.435 1.565L20.435 4.565L17.435 7.565L14.435 4.565Z"/>
                    </svg>
                </a>
                <!-- Delete Icon -->
                <button onclick="openModal()" class="hover:text-red-500">
                    <div class="group w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 19" fill="none" class="w-6 h-6 stroke-gray-700 group-hover:stroke-red-500">
                            <path d="M21 4.59962C17.67 4.34578 14.32 4.21501 10.98 4.21501C9 4.21501 7.02 4.29193 5.04 4.44578L3 4.59962M8.5 3.8227L8.72 2.81501C8.88 2.08424 9 1.53809 10.69 1.53809H13.31C15 1.53809 15.13 2.11501 15.28 2.8227L15.5 3.8227M18.85 7.03039L18.2 14.7765C18.09 15.9842 18 16.9227 15.21 16.9227H8.79C6 16.9227 5.91 15.9842 5.8 14.7765L5.15 7.03039M10.33 12.6919H13.66M9.5 9.61501H14.5"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function toggleDropdown(dropdownId) {
        document.querySelectorAll('.dropdown-content').forEach(dropdown => {
            if (dropdown.id !== dropdownId) dropdown.classList.remove('show');
        });
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('show');
    }

    window.onclick = function (event) {
        if (!event.target.closest('.relative')) {
            document.querySelectorAll('.dropdown-content').forEach(dropdown => dropdown.classList.remove('show'));
        }
    };

    function openModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

</body>
</html>