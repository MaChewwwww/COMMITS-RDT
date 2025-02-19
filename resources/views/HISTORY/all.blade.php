@extends('layouts.app-layout')

@section('content')
    <header class="px-16 mb-5">
        <div class="flex items-center justify-between">
            <h1 class="mb-2 text-2xl font-bold">History</h1>
            <div class="relative">
                <button
                    class="flex items-center px-4 py-2 text-white bg-yellow-400 rounded-md dropdown-button hover:bg-yellow-500">
                    <p class="mr-2">Filter</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="25" viewBox="0 0 32 25" fill="none">
                        <path
                            d="M15.5993 15.4256L10.1191 11.2891L11.9458 9.91016L15.5993 12.6679L19.2526 9.91016L21.0793 11.2891L15.5993 15.4256Z"
                            fill="#FFFFFF" />
                    </svg>
                </button>
                <div class="absolute right-0 hidden w-48 mt-2 bg-white rounded-lg shadow-lg dropdown-content">
                    <a href="/all" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">All</a>
                    <a href="/student" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Student</a>
                    <a href="/faculty" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Faculty</a>
                    <a href="/visitor" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Visitor</a>
                    <a href="/dependent" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dependent</a>
                </div>
            </div> 
        </div>
    </header>

    <div class="container p-5 mx-auto bg-white rounded-lg shadow-lg">
        <table class="w-full border-collapse table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Date</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Time</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Printed Name</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Sex</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Course-Yr & Sect./Dept</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Treatment Medicine</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Quantity</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Physician</th>
                    <th class="px-4 py-2 text-sm text-left text-gray-700">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Lorem</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.querySelector('.dropdown-button').addEventListener('click', function() {
            document.querySelector('.dropdown-content').classList.toggle('hidden');
        });
    </script>
@endsection
