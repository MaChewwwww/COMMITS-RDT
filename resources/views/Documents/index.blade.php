@extends('layouts.app-layout')

@section('content')
<div class="container mx-auto">
    <h1 class="mb-3 text-3xl font-semibold">Documents</h1>
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-gray-500">Recents</h2>
        <div class="flex space-x-4">
            <!-- Filter Dropdown -->
            <div class="relative inline-block text-left">
    <button onclick="toggleDropdown('document-type-dropdown')" class="bg-red-900 text-white px-2 py-2 rounded-md hover:bg-red-1000 flex">
        <p class="px-2">Document Type</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
            <path d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z" fill="#FFFFFF"/>
        </svg>
    </button>
    <div id="document-type-dropdown" class="dropdown-content absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden">
        <a href="{{ route('documents.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All</a>
        @foreach($typeOptions as $type)
            <a href="{{ route('documents.index', ['document_type' => $type]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $type }}</a>
        @endforeach
    </div>
</div>

<div class="relative inline-block text-left">
    <button onclick="toggleDropdown('date-dropdown')" class="bg-yellow-400 text-white px-2 py-2 rounded-md hover:bg-yellow-500 flex">
        <p class="px-2">Month</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
            <path d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z" fill="#FFFFFF"/>
        </svg>
    </button>
    <div id="date-dropdown" class="dropdown-content absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden">
        @foreach($MonthOptions as $index => $month)
            <a href="{{ route('documents.index', ['month' => $index + 1]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $month }}</a>
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
                    <a href="{{ route('documents.medical_certificate.create', ['document_type' => 'Medical Certificate']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Certificate</a>
                    <a href="{{ route('documents.medical_clearance.create', ['document_type' => 'Medical Clearance']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Clearance</a>
                    <a href="{{ route('documents.annual_medical_clearance.create', ['document_type' => 'Annual Medical Clearance']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Annual Medical Clearance</a>
                    <a href="{{ route('documents.excuse_letter.create', ['document_type' => 'Excuse Letter']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Excuse Letter</a>
                    <a href="{{ route('documents.waiver.create', ['document_type' => 'Waiver']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver</a>
                    <a href="{{ route('documents.waiver_for_pulmonary_case.create', ['document_type' => 'Waiver for Pulmonary Case']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver for Pulmonary Case</a>
                    <a href="{{ route('documents.dmdc_consent_form.create', ['document_type' => 'DMDC Consent Form']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">DMDC Consent Form</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recents Section -->
    <div class="space-y-4">
@if($documents->isEmpty() || $documents->where('deleted_at', '!=', null)->count() === $documents->count())
        <div class="text-center text-gray-500 font-medium p-4">
            <p>No Documents Found.</p>
        </div>
@else
    @foreach($documents as $document)
    <div id="document-container" class="bg-white p-4 rounded-lg shadow flex justify-between items-center cursor-pointer transition-all w-full">
            <a href="{{ route('documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.view', $document->id) }}">
            <div>
                <p class="font-medium text-gray-800">{{ $document->document_type }}</p>
                <p class="text-gray-600 text-sm">{{ $document->created_at->format('F j, Y') }}</p>
            </div>
            <div class="flex space-x-3">
                <!-- Edit Icon -->
                <a href="{{ route('documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.edit', $document->id) }}" class="hover:text-yellow-500">
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
            </a>
        </div>

    @endforeach
    @endif
</div>

</div>
@endsection

@if (!empty($document))
    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4 text-gray-700 text-center">Confirm Deletion</h3>
            <p class="mb-6 text-gray-600 text-sm text-center">Are you sure you want to delete the Document?</p>
            <div class="flex justify-between">
                <button id="cancel-delete" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                <form action="{{ route('documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.delete', $document->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endif


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
        document.getElementById('confirmation-modal').classList.remove('hidden');

    }

    function closeModal() {
        document.getElementById('confirmation-modal').classList.add('hidden');
    }
</script>

</body>
</html>
