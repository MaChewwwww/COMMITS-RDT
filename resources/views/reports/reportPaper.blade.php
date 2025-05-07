@extends('layouts.app-layout')

@section('content')
    <div class="flex flex-row justify-between pb-6 pr-16 text-white gap-x-5">
        <div>
            <button class="px-4 py-2 bg-gray-200 text-black rounded hover:bg-gray-300 flex items-center space-x-2"
                onclick="window.history.back()" aria-label="Go Back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                        d="M3.82843 6.9999H16V8.9999H3.82843L9.1924 14.3638L7.7782 15.778L0 7.9999L7.7782 0.22168L9.1924 1.63589L3.82843 6.9999Z"
                        fill="black" />
                </svg>
                <span>Back</span>
            </button>
        </div>
        <div class="flex gap-2">
            <button onclick="openModal()"
                class="group relative py-2 px-3 bg-amber-100 hover:bg-amber-200 hover:text-amber-600 rounded-lg font-bold text-amber-500 flex flex-col items-center space-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <span
                    class="absolute bottom-[-1.5rem] left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-white font-normal text-gray-600 px-4 text-sm py-1 rounded-md shadow">
                    Edit
                </span>
            </button>

            <button onclick="printDiv()"
                class="group relative py-2 px-3 bg-blue-100 hover:bg-blue-200 hover:text-blue-600 rounded-lg font-bold text-blue-500 flex flex-col items-center space-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                <span
                    class="absolute bottom-[-1.5rem] left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-white font-normal text-gray-600 px-4 text-sm py-1 rounded-md shadow">
                    Print
                </span>
            </button>

            <form id="exportForm" action={{ route('reports.exportExcel') }} method='GET'>

                <!-- Hidden field to hold the tableData -->
                <input type="hidden" name="tableData" id="tableData">
                <input type="hidden" name="title" id="exportTitle">
                <input type="hidden" name="from_date" id="exportFromDate">
                <input type="hidden" name="to_date" id="exportToDate">
                <input type="hidden" name="physician_name" id="exportPhysicianName">
                <input type="hidden" name="submissionDate" id="exportSubmissionDate">
                <input type="hidden" name="campusPhysician" id="exportCampusPhysician">
                <input type="hidden" name="nurse_name" id="exportCampusNurse">
                <input type="hidden" name="f2f_male" id="exportF2FMale">
                <input type="hidden" name="f2f_female" id="exportF2FFemale">
                <input type="hidden" name="online_male" id="exportOnlineMale">
                <input type="hidden" name="online_female" id="exportOnlineFemale">
                <input type="hidden" name="online_female" id="exportConsultTotal">
                <input type="hidden" name="online_female" id="exportGrandTotalMale">
                <input type="hidden" name="online_female" id="exportGrandTotalFemale">

                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg">
                    Export to Excel
                </button>
            </form>
        </div>
    </div>

    {{-- report paper --}}
    <div class="flex flex-row justify-center">
        <div id="reportPaperID" class="flex flex-col w-[90%] p-10 text-xs bg-white shadow-lg gap-y-2">
            {{-- header --}}
            <div class="flex flex-row justify-center flex-grow">
                <img id="pupLogo" alt="PUP Logo" src="{{ asset('images/puplogo.png') }}" class="w-20 h-20">
            </div>
            <div class="flex flex-col items-center" style="font-family: 'Times New Roman', Times, serif;">
                <p>Republic of the Philippines</p>
                <p>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</p>
                <p>Commonwealth, Quezon City</p>
                <p id="titleOut"></p>
                <div class="flex flex-row items-center justify-center w-full gap-x-3">
                    <p id="fromDurationDateOut" class="mt-4"></p>
                    <p id="toDurationDateOut" class="mt-4"></p>
                </div>
            </div>
            <div class="flex flex-row justify-between px-6">
                <div class="flex flex-col">
                    <p>Name of Physician:</p>
                    <p id="physicianNameOut"></p>
                </div>
                <div class="flex flex-col pr-16">
                    <p>Date of submission</p>
                    <p id="submissionDateOut"></p>
                </div>
            </div>
            {{-- table --}}
            <table class="border border-collapse border-black table-auto text-start">
                <thead>
                    <tr id="table-header" class="text-center">
                        <th class="font-normal border border-black">Medical Services Rendered</th>
                        <th class="font-normal border border-black">Students</th>
                        <th class="font-normal border border-black">Faculty</th>
                        <th class="font-normal border border-black">Administrative</th>
                        <th class="font-normal border border-black">Dependents</th>
                        <th class="font-normal border border-black">Visitors</th>
                        <th class="font-normal border border-black">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- creates the table --}}
                    @foreach ($services as $service)
                        <tr>
                            <td
                                class="w-64 pl-5 border border-black
                            {{-- add padding only to specific cells --}}
                            {{ in_array($loop->index, [
                                2,
                                7,
                                13,
                                15,
                                16,
                                17,
                                18,
                                19,
                                21,
                                22,
                                23,
                                24,
                                25,
                                27,
                                28,
                                29,
                                31,
                                32,
                                33,
                                35,
                                36,
                                37,
                                38,
                                39,
                                42,
                                44,
                                45,
                                46,
                            ])
                                ? 'pl-7'
                                : (in_array($loop->index, [3, 4, 5, 6, 8, 9, 10, 11, 12])
                                    ? 'pl-9'
                                    : '') }}">
                                {{ $service['name'] }}</td>
                            @foreach ($service['data'] as $data)
                                <td class="border border-black cells">
                                    @if ($loop->last)
                                        <input type="text" class="w-full text-center outline-none remarks-input">
                                    @else
                                        <p class="w-full text-center">{{ $data }}</p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- table 2 --}}
            <table id="table2" class="mt-5 font-semibold w-[60%]">
                <tbody>
                    <tr class="text-center">
                        <td class="pl-5 font-semibold border border-black text-start">Total F2F Consults</td>
                        <td class="text-center border border-black bg-amber-400">
                            <div class="flex flex-row justify-center gap-x-1">
                                M = <p id="f2fConsultMaleOut"></p>
                        </td>
        </div>
        <td class="text-center border border-black bg-amber-400">
            <div class="flex flex-row justify-center gap-x-1">
                F = <p id="f2fConsultFemaleOut"></p>
        </td>
    </div>
    <td class="px-2 text-center border border-black bg-amber-400">
        <div class="flex flex-row justify-center gap-x-1">
            <p id="f2fConsultTotalOut"></p>
    </td>
    </div>
    </tr>
    <tr class="text-center">
        <td class="pl-5 font-semibold border border-black text-start">Total Online Consults</td>
        <td class="text-center border border-black bg-amber-400">
            <div class="flex flex-row justify-center gap-x-1">
                M = <p id="onlineConsultMaleOut"></p>
        </td>
        </div>
        <td class="text-center border border-black bg-amber-400">
            <div class="flex flex-row justify-center gap-x-1">
                F = <p id="onlineConsultFemaleOut"></p>
        </td>
        </div>
        <td class="px-2 text-center border border-black bg-amber-400">
            <div class="flex flex-row justify-center gap-x-1">
                <p id="onlineConsultTotalOut"></p>
        </td>
        </div>
    </tr>
    <tr class="text-center">
        <td class="pl-5 font-semibold border border-black text-start">Grand Total</td>
        <td class="text-center bg-green-400 border border-black">
            <div class="flex flex-row justify-center gap-x-1">
                M = <p id="grandTotalMaleOut"></p>
        </td>
        </div>
        <td class="text-center bg-green-400 border border-black">
            <div class="flex flex-row justify-center gap-x-1">
                F = <p id="grandTotalFemaleOut"></p>
        </td>
        </div>
        <td class="px-2 text-center bg-green-400 border border-black">
            <div class="flex flex-row justify-center gap-x-1">
                <p id="grandTotalOut"></p>
        </td>
        </div>
    </tr>
    </tbody>
    </table>
    <div id="footer" class="w-[80%] flex flex-row gap-x-32 pl-10 pt-20 pb-20">
        <div class="flex flex-col">
            <p id="campusPhysicianOut"></p>
            <p>Campus Physician</p>
        </div>
        <div class="flex flex-col">
            <p id="campusNurseOut"></p>
            <p>Campus Nurse</p>
        </div>
    </div>
    </div>
    </div>

    <!--================== Start Edit Report Modal ====================-->
    @include('reports.edit-report')

    {{-- <div id="addReportModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
        <div
            class="bg-white p-6 rounded-lg shadow-lg w-[80vh] max-w-auto max-w-4xl mx-4 sm:mx-auto overflow-y-auto max-h-[80vh] relative">
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute text-xl font-bold text-red-600 top-4 right-4">
                ✖
            </button>

            <h5 class="mb-4 text-xl font-bold text-center">Edit Report Paper</h5>

            <form id="addReportForm" class="space-y-4">
                @csrf

                <div>
                    <div class="flex flex-row gap-x-1">
                        <label for="title" class="block text-sm font-semibold">Title</label><span
                            class="text-red-500">*</span>
                    </div>
                    <input type="text" id="title" name="title" class="w-full p-2 border rounded-md" required>
                </div>

                <div>
                    <div class="flex flex-row gap-x-1">
                        <label for="physicianName" class="block text-sm font-semibold">Name of physician</label><span
                            class="text-red-500">*</span>
                    </div>
                    <input type="text" id="physicianName" name="physicianName" class="w-full p-2 border rounded-md"
                        required>
                </div>

                <div class="flex flex-col sm:w-1/2">
                    <div class="flex flex-row gap-x-1">
                        <label class="justify-start block text-sm font-semibold">Duration date</label><span
                            class="text-red-500">*</span>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-col">
                            <label for="fromDurationDate" class="block text-sm font-semibold">From</label>
                            <input type="datetime-local" id="fromDurationDate" name="fromDurationDate"
                                class="w-3/4 p-2 border rounded-md " required>
                        </div>
                        <div class="flex flex-col">
                            <label for="toDurationDate" class="block text-sm font-semibold">To</label>
                            <input type="datetime-local" id="toDurationDate" name="toDurationDate"
                                class="w-3/4 p-2 pr-0 border rounded-md " required>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-1/2">
                    <div class="flex flex-row gap-x-1">
                        <label for="submissionDate" class="block text-sm font-semibold">Date of submission</label><span
                            class="text-red-500">*</span>
                    </div>
                    <input type="datetime-local" id="submissionDate" name="submissionDate"
                        class="w-full p-2 border rounded-md" required>
                </div>
                <div class="w-full sm:w-1/2">
                    <div class="flex flex-row gap-x-1">
                        <label for="campusPhysician" class="block text-sm font-semibold">Campus physician</label><span
                            class="text-red-500">*</span>
                    </div>
                    <input type="text" id="campusPhysician" name="campusPhysician"
                        class="w-full p-2 border rounded-md" required>
                </div>

                <div class="w-full sm:w-1/2">
                    <div class="flex flex-row gap-x-1">
                        <label for="campusNurse" class="block text-sm font-semibold">Campus nurse</label><span
                            class="text-red-500">*</span>
                    </div>
                    <input type="text" id="campusNurse" name="campusNurse" class="w-full p-2 border rounded-md"
                        required>
                </div>

                <div class="flex flex-col sm:w-1/2">
                    <div class="flex flex-row gap-x-1">
                        <label class="justify-start block text-sm font-semibold">Total F2F Consults</label><span
                            class="text-red-500">*</span>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-col">
                            <label for="f2fConsultMale" class="block text-sm font-semibold">Male</label>
                            <input type="number" id="f2fConsultMale" name="f2fConsultMale"
                                class="w-3/4 p-2 text-center border rounded-md " required>
                        </div>
                        <div class="flex flex-col">
                            <label for="f2fConsultFemale" class="block text-sm font-semibold">Female</label>
                            <input type="number" id="f2fConsultFemale" name="f2fConsultFemale"
                                class="w-3/4 p-2 text-center border rounded-md " required>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:w-1/2">
                    <div class="flex flex-row gap-x-1">
                        <label class="justify-start block text-sm font-semibold">Total Online Consults</label><span
                            class="text-red-500">*</span>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-col">
                            <label for="f2fConsultMale" class="block text-sm font-semibold">Male</label>
                            <input type="number" id="onlineConsultMale" name="onlineConsultMale"
                                class="w-3/4 p-2 text-center border rounded-md " required>
                        </div>
                        <div class="flex flex-col">
                            <label for="f2fConsultFemale" class="block text-sm font-semibold">Female</label>
                            <input type="number" id="onlineConsultFemale" name="onlineConsultFemale"
                                class="w-3/4 p-2 text-center border rounded-md " required>
                        </div>
                    </div>
                </div>

                <button id="submitBtn" onclick="saveEdit()" type="button"
                    class="w-full p-3 text-white bg-green-500 rounded-md hover:bg-green-600">
                    Save
                </button>
            </form>
        </div>
    </div> --}}

    <style>
        /* Custom CSS to hide the spinners */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>

@endsection

@push('scripts')
    <script>
        let tableData = null;
        // print report paper
        function printDiv() {

            // Update the remarks input's attribute so the printed HTML contains the current value
            const remarkInputs = document.querySelectorAll('.remarks-input');
            remarkInputs.forEach(function(input) {
                input.setAttribute('value', input.value);
            });

            const content = document.getElementById('reportPaperID').outerHTML;

            // Open a new print window
            const printWindow = window.open('', '', 'height=800,width=1000');

            printWindow.document.write(`
            <html>
                <head>
                    <title>Print Report</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            @page {
                                size: auto;
                                margin: 0;
                            }
                            body {
                                background: white;
                            }
                            #reportPaperID {
                                padding: 0.3cm 1cm;
                                font-size: 12px;
                                margin-bottom: 0cm;
                                margin-top: 0cm;
                                page-break-inside: avoid;
                                max-height: 100vh;
                                height: 100vh;
                                overflow: hidden;
                            }
                            table {
                                width: 100%;
                                height: auto;
                                font-size: 7px;
                                text-align: left;
                                padding: 0cm;
                            }
                            #table-header {
                                text-align: center;
                            }
                            #table2 {
                                margin-top: 0cm;
                                width: 50vh;
                            }
                            tr {
                                page-break-inside: avoid;
                            }
                            #pupLogo{
                                width: 40px;
                                height: 40px;
                            }
                            #footer {
                                padding-top: 0cm;
                                margin-bottom: 1cm;
                            }
                            .font-semibold {
                                text-align: left;
                                padding-left: 10px
                            }
                            .cells {
                                padding-left: 10px;
                            }
                        }
                    </style>
                </head>
                <body>${content}</body>
            </html>
        `);

            // Ensure the styles are fully loaded before printing
            printWindow.document.close();
            printWindow.onload = () => {
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            };
        }

        function openModal() {
            // Get the values from the form
            // document.getElementById('addReportModal').classList.remove('hidden');
            let modal = document.getElementById("editModal");
            let modalContent = modal.querySelector("div.relative");

            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.remove("opacity-0");
                modalContent.classList.remove("scale-95");
                modalContent.classList.add("scale-100");
            }, 10); // Small delay to trigger animation
        }

        function closeModal() {
            // document.getElementById('addReportModal').classList.add('hidden');

            let modal = document.getElementById("editModal");
            let modalContent = modal.querySelector("div.relative");

            modal.classList.add("opacity-0");
            modalContent.classList.remove("scale-100");
            modalContent.classList.add("scale-95");

            setTimeout(() => {
                modal.classList.add("hidden");
            }, 300); // Matches transition duration
        }

        function saveEdit() {

            const title = document.getElementById('title');
            const physicianName = document.getElementById('physicianName');
            const fromDurationDate = document.getElementById('fromDurationDate');
            const toDurationDate = document.getElementById('toDurationDate');
            const submissionDate = document.getElementById('submissionDate');
            const campusPhysician = document.getElementById('campusPhysician');
            const campusNurse = document.getElementById('campusNurse');
            const totalF2FConsultsMale = document.getElementById('f2fConsultMale');
            const totalF2FConsultsFemale = document.getElementById('f2fConsultFemale');
            const totalOnlineConsultsMale = document.getElementById('onlineConsultMale');
            const totalOnlineConsultsFemale = document.getElementById('onlineConsultFemale');

            // Outputs
            const titleOut = document.getElementById('titleOut');
            const physicianNameOut = document.getElementById('physicianNameOut');
            const fromDurationDateOut = document.getElementById('fromDurationDateOut');
            const toDurationDateOut = document.getElementById('toDurationDateOut');
            const submissionDateOut = document.getElementById('submissionDateOut');
            const campusPhysicianOut = document.getElementById('campusPhysicianOut');
            const campusNurseOut = document.getElementById('campusNurseOut');
            const f2fConsultMaleOut = document.getElementById('f2fConsultMaleOut');
            const f2fConsultFemaleOut = document.getElementById('f2fConsultFemaleOut');
            const f2fConsultTotalOut = document.getElementById('f2fConsultTotalOut');
            const onlineConsultMaleOut = document.getElementById('onlineConsultMaleOut');
            const onlineConsultFemaleOut = document.getElementById('onlineConsultFemaleOut');
            const onlineConsultTotalOut = document.getElementById('onlineConsultTotalOut');
            const grandTotalMaleOut = document.getElementById('grandTotalMaleOut');
            const grandTotalFemaleOut = document.getElementById('grandTotalFemaleOut');
            const grandTotalOut = document.getElementById('grandTotalOut');

            // Check if any field is empty
            // if (!title.value || !physicianName.value || !fromDurationDate.value ||
            //     !toDurationDate.value || !submissionDate.value || !campusPhysician.value ||
            //     !campusNurse.value || !totalF2FConsultsMale.value || !totalF2FConsultsFemale.value ||
            //     !totalOnlineConsultsMale.value || !totalOnlineConsultsFemale.value) {
            //     alert('Please fill out all fields.');
            //     return; // Prevent form submission
            // }

            // Helper: extract date parts
            const getDateParts = (dateStr) => {
                const dateObj = new Date(dateStr.split('T')[0]);
                return {
                    month: dateObj.toLocaleString('en-US', {
                        month: 'long'
                    }),
                    day: dateObj.getDate(),
                    year: dateObj.getFullYear()
                };
            };

            // Helper: format the date range based on common parts
            const formatDateRange = (fromStr, toStr) => {
                const from = getDateParts(fromStr);
                const to = getDateParts(toStr);

                // If both dates are exactly the same, return one date.
                if (from.day === to.day && from.month === to.month && from.year === to.year) {
                    return `${from.month} ${from.day}, ${from.year}`;
                }
                // If month and year are the same, only display the day for the "to" date.
                if (from.month === to.month && from.year === to.year) {
                    return `${from.month} ${from.day} to ${to.day}, ${from.year}`;
                }
                // If the year is the same but months differ.
                if (from.year === to.year) {
                    return `${from.month} ${from.day} to ${to.month} ${to.day}, ${from.year}`;
                }
                // If years differ, return full dates for both.
                return `${from.month} ${from.day}, ${from.year} to ${to.month} ${to.day}, ${to.year}`;
            };

            // Update the values in the report paper
            titleOut.innerHTML = title.value;
            physicianNameOut.innerHTML = physicianName.value;
            fromDurationDateOut.innerHTML = formatDateRange(fromDurationDate.value, toDurationDate.value);
            // Clear the separate "to" output if not needed.
            toDurationDateOut.innerHTML = "";
            submissionDateOut.innerHTML = new Date(submissionDate.value.split('T')[0])
                .toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });
            campusPhysicianOut.innerHTML = campusPhysician.value;
            campusNurseOut.innerHTML = campusNurse.value;
            f2fConsultMaleOut.innerHTML = totalF2FConsultsMale.value;
            f2fConsultFemaleOut.innerHTML = totalF2FConsultsFemale.value;
            f2fConsultTotalOut.innerHTML = parseInt(totalF2FConsultsMale.value) + parseInt(totalF2FConsultsFemale.value);
            onlineConsultMaleOut.innerHTML = totalOnlineConsultsMale.value;
            onlineConsultFemaleOut.innerHTML = totalOnlineConsultsFemale.value;
            onlineConsultTotalOut.innerHTML = parseInt(totalOnlineConsultsMale.value) + parseInt(totalOnlineConsultsFemale
                .value);
            grandTotalMaleOut.innerHTML = parseInt(totalF2FConsultsMale.value) + parseInt(totalOnlineConsultsMale.value);
            grandTotalFemaleOut.innerHTML = parseInt(totalF2FConsultsFemale.value) + parseInt(totalOnlineConsultsFemale
                .value);
            grandTotalOut.innerHTML = parseInt(grandTotalMaleOut.innerHTML) + parseInt(grandTotalFemaleOut.innerHTML);

            // AJAX request to send data to the controller
            const data = {
                title: title.value,
                physicianName: physicianName.value,
                fromDurationDate: fromDurationDate.value,
                toDurationDate: toDurationDate.value,
                submissionDate: submissionDate.value,
                campusPhysician: campusPhysician.value,
                campusNurse: campusNurse.value,
                category: document.getElementById('category') ? document.getElementById('category').value :
                '', // if available in the form
                _token: '{{ csrf_token() }}' // Include CSRF token if needed
            };

            fetch('{{ route('reports.filterAndCountReports') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(services => {
                    console.log('Success:', services);
                    tableData = services;

                    document.getElementById('tableData').value = JSON.stringify(tableData);

                    // Handle success response
                    // Update table inputs based on the returned services array.
                    // populates the table
                    const tableRows = document.querySelectorAll('table tbody tr');
                    services.forEach((service, serviceIndex) => {
                        if (tableRows[serviceIndex]) {
                            const pElements = tableRows[serviceIndex].querySelectorAll('td.cells p');
                            service.data.forEach((count, i) => {
                                if (pElements[i]) {
                                    pElements[i].innerText = count;
                                }
                            });
                        }
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

            closeModal();
        }
        document.getElementById('exportForm').addEventListener('submit', function(event) {

            const remarksInputs = document.querySelectorAll('.remarks-input');

            remarksInputs.forEach((input, index) => {
                if (tableData[index] && Array.isArray(tableData[index].data)) {
                    // Update the remark field; assuming the last element of data is for remarks
                    tableData[index].data[tableData[index].data.length - 1] = input.value;
                }
            });

            // Update the hidden input with the updated services array
            document.getElementById('tableData').value = JSON.stringify(tableData);

            // Also update other hidden inputs with the values from the report paper
            document.getElementById('exportTitle').value = document.getElementById('titleOut').innerText;
            document.getElementById('exportFromDate').value = document.getElementById('fromDurationDateOut')
                .innerText;
            document.getElementById('exportToDate').value = document.getElementById('toDurationDateOut').innerText;
            document.getElementById('exportPhysicianName').value = document.getElementById('physicianNameOut')
                .innerText;
            document.getElementById('exportSubmissionDate').value = document.getElementById('submissionDateOut')
                .innerText;
            document.getElementById('exportCampusPhysician').value = document.getElementById('campusPhysicianOut')
                .innerText;
            document.getElementById('exportCampusNurse').value = document.getElementById('campusNurseOut')
                .innerText;
            document.getElementById('exportF2FMale').value = document.getElementById('f2fConsultMaleOut').innerText;
            document.getElementById('exportF2FFemale').value = document.getElementById('f2fConsultFemaleOut')
                .innerText;
            document.getElementById('exportOnlineMale').value = document.getElementById('f2fConsultTotalOut')
                .innerText;
            document.getElementById('exportOnlineFemale').value = document.getElementById('onlineConsultFemaleOut')
                .innerText;
            document.getElementById('exportConsultTotal').value = document.getElementById('grandTotalOut')
                .innerText;
            document.getElementById('exportGrandTotalMale').value = document.getElementById('grandTotalMaleOut')
                .innerText;
            document.getElementById('exportGrandTotalFemale').value = document.getElementById('grandTotalFemaleOut')
                .innerText;
        });
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
