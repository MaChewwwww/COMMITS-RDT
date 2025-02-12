@extends('layouts.app-layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-2">Document's</h1>
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-gray-500">Recents</h2>
        <div class="flex space-x-4">
            <!-- Filter Dropdown -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown('filter-dropdown')" class="bg-yellow-400 text-white px-2 py-2 rounded-md hover:bg-yellow-500 flex">
                    <p class="px-2">Filter</p> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                        <path d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z" fill="#FFFFFF"/>
                        </svg>
                </button>
                <div id="filter-dropdown" class="dropdown-content absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Week</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Month</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Year</a>
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
                    <a href="/med_certif" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Certificate</a>
                    <a href="/med_clear" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Clearance</a>
                    <a href="/annual_med_clear" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Annual Medical Clearance</a>
                    <a href="/excuse_letter" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Excuse Letter</a>
                    <a href="/waiver" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver</a>
                    <a href="/waiver_for_pulm" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver for Pulmonary Case</a>
                    <a href="/dmdc_consent_form" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">DMDC Consent Form</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recents Section -->
    <div class="space-y-4">
        <!-- Example Document -->
        <div id="document-container" class="bg-white p-4 rounded-lg shadow flex justify-between items-center cursor-pointer transition-all">
            <div>
                <p class="font-medium text-gray-800">Document Name - Name</p>
                <p class="text-sm text-gray-400">Created on: 2024-12-24</p>
            </div>
            <div class="flex space-x-3">
                <!-- Download Icon -->
                <button class="hover:text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                        <path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"/>
                    </svg>
                </button>
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
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-[90%] max-w-sm text-center">
            <h2 class="text-lg font-semibold text-gray-700">Are you sure you want to delete?</h2>
            <div class="flex justify-center gap-4 mt-6">
                <button onclick="closeModal()" class="px-4 py-2 border border-gray-400 rounded-full text-gray-700 hover:bg-gray-100">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-red-600 text-white rounded-full hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
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

    let clickCount = 0;
    let clickTimeout;

    document.getElementById('document-container').addEventListener('click', function(event) {
        clickCount++;

        // Hover effect on first click
        if (clickCount === 1) {
            event.target.closest('div').classList.add('hover-bg'); // Add hover effect class
            clickTimeout = setTimeout(function() {
                clickCount = 0; // Reset click count if no second click
                event.target.closest('div').classList.remove('hover-bg'); // Remove hover effect
            }, 300); // Timeout for the second click to happen within 300ms
        }

        // Open document on second click
        if (clickCount === 2) {
            clearTimeout(clickTimeout); // Clear the timeout
            clickCount = 0; // Reset the count
            openDocument(); // Replace with the actual function to open the document
        }
    });

    // This is a placeholder for your document opening function
    function openDocument() {
        alert("Document Opened!"); // Replace with actual code to open the document
    }
</script>

@endsection


