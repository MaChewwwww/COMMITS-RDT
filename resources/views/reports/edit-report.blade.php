<div id="editFormModal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 ease-out opacity-0 bg-black/50">
    <!-- Modal content -->
    <div
        class="relative w-full h-full max-w-2xl p-4 transition-transform duration-300 ease-out transform scale-95 bg-white rounded-lg shadow md:h-auto sm:p-5">
        <!-- Modal header -->
        <div class="flex items-center justify-between pb-4 mb-4 rounded-t sm:mb-5">
            <h3 class="text-lg font-semibold text-gray-900">
                Edit Report Paper
            </h3>
            <button type="button" onclick="closeEditFormModal()"
                class="inline-flex items-center p-2 ml-auto text-sm text-gray-400 bg-gray-200 rounded-full focus:ring-4 focus:outline-none focus:ring-gray-300 hover:bg-gray-300 hover:text-gray-900"
                data-modal-toggle="editReportModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <form onsubmit="saveEdit(event)" class="max-h-[80vh] overflow-y-auto " id="editReportForm">
            @csrf
            <div class="grid gap-4 px-2 mx-3 mb-4 sm:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Report title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter title of the report" required="">
                </div>
                <div>
                    <label for="physicianName" class="block mb-2 text-sm font-medium text-gray-900">Name of Physician
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="physicianName" id="physicianName"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter physician's full name" required="">
                </div>
                <div>
                    <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="position" id="position"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter position" required="">
                </div>
                <div>
                    <label for="unitDepartment" class="block mb-2 text-sm font-medium text-gray-900">Unit / Department <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="unitDepartment" id="unitDepartment"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter unit / department" required="">
                </div>
                <div>
                    <label for="campusPhysician" class="block mb-2 text-sm font-medium text-gray-900">Campus Physician
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="campusPhysician" id="campusPhysician"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter campus physician's full name" required="">
                </div>
                <div>
                    <label for="campusNurse" class="block mb-2 text-sm font-medium text-gray-900">Campus Nurse <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="campusNurse" id="campusNurse"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter campus nurse's full name" required="">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Duration date <span
                            class="text-red-500">*</span></label>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">From</label>
                        <input type="datetime-local" id="fromDurationDate" name="fromDurationDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            required>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-transparent">Duration date </label>
                    <div>
                        <label for="toDurationDate" class="block mb-2 text-sm font-medium text-gray-900">To</label>
                        <input type="datetime-local" id="toDurationDate" name="toDurationDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            required>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="submissionDate" class="block mb-2 text-sm font-medium text-gray-900">Date of submission
                            <span class="text-red-500">*</span></label>
                        <input type="datetime-local" id="submissionDate" name="submissionDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            required>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="controlNumberDate" class="block mb-2 text-sm font-medium text-gray-900">Control number date <span
                            class="text-red-500">*</span></label></label>
                        <input type="datetime-local" id="controlNumberDate" name="controlNumberDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            required>
                    </div>
                </div>
                <div>
                    <label for="controlNumber" class="block mb-2 text-sm font-medium text-gray-900">Control number <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="controlNumber" id="controlNumber"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter control number" required="">
                </div>
            
                <div>
                    <label for="controlNumberRevision" class="block mb-2 text-sm font-medium text-gray-900">Revision <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="controlNumberRevision" id="controlNumberRevision"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter number of revisions" required="">
                </div>
            </div>
            {{-- action buttons --}}
            <div class="flex items-center justify-end w-full gap-3 pr-5 mt-6 mb-4">
                <button type="button" onclick="closeEditFormModal()"
                    class="flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-300 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 sm:w-auto">
                    Close
                </button>
                <button id="submitBtn" onclick="saveEdit()" type="submit"
                    class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white bg-green-500 rounded-lg focus:ring-4 focus:outline-none focus:ring-green-300 hover:bg-green-600 bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>