@extends('layouts.app-layout')

@section('content')
    <div class="container mx-auto">
        <x-page-title class="mb-2" value="History" />

        <div class="flex flex-wrap items-center justify-end w-full gap-2 mb-3">
            <!-- Filter Dropdowns -->
            <div class="flex space-x-2 flex-wrap>
                <!-- Month Dropdown -->
                <div class="relative
                inline-block text-left">
                <button onclick="toggleDropdown('month-dropdown')"
                    class="flex items-center px-4 py-2 text-white bg-yellow-400 rounded-md hover:bg-yellow-500">
                    <p class="px-2">{{ $selectedMonth ?? 'All Month' }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </button>
                <div id="month-dropdown"
                    class="absolute left-0 hidden w-40 mt-2 bg-white border border-gray-200 rounded shadow-lg dropdown-content">
                    <ul class="py-1">
                        <li><a href="{{ route('History.all') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All</a></li>
                        @foreach ($months as $month)
                            <li><a href="{{ route('History.all', ['month' => $month]) }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $month }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Week Dropdown -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown('week-dropdown')"
                    class="flex items-center px-4 py-2 text-white bg-red-900 rounded-md hover:bg-red-1000">
                    <p class="px-2">Week {{ $selectedWeek ?? 'All' }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                        viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </button>
                <div id="week-dropdown"
                    class="absolute left-0 hidden w-40 mt-2 bg-white border border-gray-200 rounded shadow-lg dropdown-content">
                    <ul class="py-1">
                        <li><a href="{{ route('History.all') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All</a></li>
                        @foreach ($weeks as $week)
                            <li><a href="{{ route('History.all', ['week' => $week]) }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Week {{ $week }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Grouping Records by Date -->
    @php
        $sortedRecords = $records->sortByDesc('updated_at');
        $groupedRecords = $sortedRecords->groupBy(function ($record) {
            return \Carbon\Carbon::parse($record->created_at)->format('l, F j, Y'); // Format by full date
        });
    @endphp

    @if ($groupedRecords->isEmpty())
        <p class="text-center text-gray-600">No records found.</p>
    @else
        @foreach ($groupedRecords as $date => $dateRecords)
            <div class="p-4 mb-6 bg-white border border-gray-200 rounded shadow-lg">
                <h2 class="mb-2 text-lg font-semibold text-gray-700">{{ $date }}</h2>
                <ul class="space-y-2">
                    @foreach ($dateRecords as $record)
                        <li class="flex items-center space-x-4 history-item">
                            <span class="text-sm font-normal text-gray-700 underline">{{ $record->patient_name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endif
    </div>

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
    </script>

@endsection
