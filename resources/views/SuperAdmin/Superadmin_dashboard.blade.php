@extends('layouts.app-layoutadmin')

@section('title', 'Super Admin')

@section('content')
    <div class="mx-auto">
        <div class="flex justify-center">
            <div class="w-full">
                <x-page-title value="Dashboard" />
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Rectangle 1 -->
            <div
                class="flex items-center justify-center p-4 min-w-fit border-1 border-gray-200 bg-white rounded-lg shadow-md space-x-3">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center text-blue-500 bg-blue-50 rounded-full w-14 h-14">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-4xl font-semibold">{{ $total_users }}</p>
                    <h2 class="text-base font-regular text-gray-600 text-wrap mt-1">Total Users</h2>
                </div>
            </div>

            <!-- Rectangle 2 -->
            <div
                class="flex items-center justify-center p-4 min-w-fit border-1 border-gray-200 bg-white rounded-lg shadow-md space-x-3">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center text-green-500 bg-green-50 rounded-full w-14 h-14">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-receipt" viewBox="0 0 16 16">
                            <path
                                d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                            <path
                                d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-4xl font-semibold">{{ $total_active_users }}</p>
                    <h2 class="text-base font-regular text-gray-600 text-wrap mt-1">Total Active Users</h2>
                </div>
            </div>

            <!-- Rectangle 3 -->
            <div
                class="flex items-center justify-center p-4 min-w-fit border-1 border-gray-200 bg-white rounded-lg shadow-md space-x-3">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center text-indigo-500 bg-indigo-50 rounded-full w-14 h-14">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2z" />
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-4xl font-semibold">{{ $total_inactive_users }}</p>
                    <h2 class="text-base font-regular text-gray-600 text-wrap mt-1">Total Inactive Users</h2>
                </div>
            </div>
        </div>

    </div>
@endsection
