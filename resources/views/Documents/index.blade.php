@extends('layouts.app-layout')

@section('title', 'Documents')

@section('content')
    <div class="container mx-auto">
        <x-page-title class="mb-2" value="Documents" />
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-gray-500">Recents</h2>
            <div class="flex flex-wrap items-center justify-end w-full gap-2 mb-4">
                <!-- Filter Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown('document-type-dropdown')"
                        class="inline-flex items-center gap-1 px-2 py-2.5 text-blue-500 bg-blue-100 hover:bg-blue-200 rounded-lg transition-all duration-200">
                        <p class="px-2">Document Type</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25"
                            fill="none">
                            <path
                                d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                    <div id="document-type-dropdown"
                        class="dropdown-content absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden">
                        <a href="{{ route('documents.index') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All</a>
                        @foreach ($typeOptions as $type)
                            <a href="{{ route('documents.index', ['document_type' => $type]) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $type }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="relative">
                    <button onclick="toggleDropdown('date-dropdown')"
                        class="inline-flex items-center gap-1 px-3 py-2.5 text-blue-500 bg-blue-100 hover:bg-blue-200 rounded-lg transition-all duration-200">
                        <p class="px-2">Month</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25"
                            fill="none">
                            <path
                                d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                    <div id="date-dropdown"
                        class="dropdown-content absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden">
                        @foreach ($MonthOptions as $index => $month)
                            <a href="{{ route('documents.index', ['month' => $index + 1]) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $month }}</a>
                        @endforeach
                    </div>
                </div>

                <!-- Add Dropdown -->
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown('add-dropdown')"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-white bg-blue-500 hover:bg-blue-600 rounded-lg transition-all duration-200 transform active:translate-y-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 17 17"
                            fill="none">
                            <path
                                d="M7.35714 9.64286H0.5V7.35714H7.35714V0.5H9.64286V7.35714H16.5V9.64286H9.64286V16.5H7.35714V9.64286Z"
                                fill="white" />
                        </svg>
                        <p class="px-2">Add</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25"
                            fill="none">
                            <path
                                d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                                fill="#FFFFFF" />
                        </svg>
                    </button>
                    <div id="add-dropdown"
                        class="dropdown-content absolute z-50 right-0 mt-2 w-64 bg-white border border-gray-200 rounded shadow-lg">
                        <a href="{{ route('documents.medical_certificate.create', ['document_type' => 'Medical Certificate']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Certificate</a>
                        <a href="{{ route('documents.medical_clearance.create', ['document_type' => 'Medical Clearance']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Medical Clearance</a>
                        <a href="{{ route('documents.annual_medical_clearance.create', ['document_type' => 'Annual Medical Clearance']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Annual Medical Clearance</a>
                        <a href="{{ route('documents.excuse_letter.create', ['document_type' => 'Excuse Letter']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Excuse Letter</a>
                        <a href="{{ route('documents.waiver.create', ['document_type' => 'Waiver']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver</a>
                        <a href="{{ route('documents.waiver_for_pulmonary_case.create', ['document_type' => 'Waiver for Pulmonary Case']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Waiver for Pulmonary Case</a>
                        <a href="{{ route('documents.dmdc_consent_form.create', ['document_type' => 'DMDC Consent Form']) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">DMDC Consent Form</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recents Section -->
        <div class="space-y-4">
            @if ($documents->isEmpty() || $documents->where('deleted_at', '!=', null)->count() === $documents->count())
                <div class="text-center text-gray-500 font-medium p-4">
                    <p>No Documents Found.</p>
                </div>
            @else
                @foreach ($documents as $document)
                    <div id="document-container"
                        class="bg-white p-4 rounded-lg shadow flex justify-between items-center cursor-pointer transition-all w-full">
                        <div>
                            <p class="font-medium text-gray-800">{{ $document->document_type }}</p>
                            <p class="text-gray-600 text-sm">{{ $document->created_at->format('F j, Y') }}</p>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <!-- Actions dropwdown -->
                            <div class="relative">
                                <button onclick="toggleDropdown('actions-dropdown-{{ $document->id }}')"
                                    class="inline-flex items-center gap-1 p-2 text-gray-700 bg-gray-200 text-sm hover:bg-gray-300 rounded-lg transition-all duration-200">
                                    <p class="pl-2">Actions</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25"
                                        viewBox="0 0 32 25" fill="none">
                                        <path
                                            d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                                <div id="actions-dropdown-{{ $document->id }}"
                                    class="dropdown-content text-center text-sm z-50 absolute left-0 mt-2 w-28 bg-white border border-gray-200 rounded shadow-lg hidden">
                                    <a href="{{ route('documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.view', $document->id) }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View</a>
                                    <a href="{{ route('documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.edit', $document->id) }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</a>
                                    <form id="delete-document-{{$document->id}}"
                                        action="{{ route('documents.' . strtolower(str_replace(' ', '_', $document->document_type)) . '.delete', $document->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a type="button" onclick="confirmDelete('delete-document-{{$document->id}}')"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Delete</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleDropdown(dropdownId) {
            document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                if (dropdown.id !== dropdownId) dropdown.classList.remove('show');
            });
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('.dropdown-content').forEach(dropdown => dropdown.classList.remove('show'));
            }
        };

        function confirmDelete(id) {
            let form = document.getElementById(id);

            Swal.fire({
                title: "Warning!",
                text: "Are you sure you want to delete this document?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#FF0000',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: `{!! session('success') !!}`,
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: `{!! session('error') !!}`,
                icon: "error"
            });
        </script>
    @endif
@endpush
