<div id="editFormModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 opacity-0 transition-opacity duration-300 ease-out">
    <!-- Modal content -->
    <div
        class="relative p-4 w-full max-w-2xl h-full md:h-auto transform scale-95 transition-transform duration-300 ease-out bg-white rounded-lg shadow sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t sm:mb-5">
            <h3 class="text-lg font-semibold text-gray-900">
                Edit User Details
            </h3>
            <button type="button" onclick="closeEditModal()"
                class="text-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 bg-gray-200 hover:bg-gray-300 hover:text-gray-900 rounded-full text-sm p-2 ml-auto inline-flex items-center"
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
        <form action="{{ route('user.update') }}" method="POST" class="max-h-[80vh] overflow-y-auto ">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2 px-2">
                <input type="hidden" value="" name="id" id="user_id"/>

                <!-- First Name Field -->
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First name
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" id="edit_first_name"
                        class=" bg-gray-50 border border-gray-300 cursor-not-allowed text-gray-500 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter first name" disabled>
                </div>

                <!-- last Name Field -->
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last name
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" id="edit_last_name"
                        class=" bg-gray-50 border border-gray-300 cursor-not-allowed text-gray-500 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter last name" disabled>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email
                        <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="edit_email"
                        class=" bg-gray-50 border border-gray-300 cursor-not-allowed text-gray-500 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                        placeholder="Enter email" disabled>
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role
                        <span class="text-red-500">*</span></label>
                    <select name="role" id="edit_role"
                        class=" bg-gray-50 border border-gray-300 text-gray-500 cursor-not-allowed text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5" disabled>
                        <option value="" selected >Select a role</option>
                        <option value="standard">Standard User</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status
                        <span class="text-red-500">*</span></label>
                    <select name="status" id="edit_status"
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5" required>
                        <option value="" selected >Select a status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                        <option value="deactivated">Deactivated</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end w-full gap-3 mt-6">
                <button onclick="closeEditModal()" type="button"
                    class="flex w-full justify-center focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 sm:w-auto">
                    Close
                </button>
                <button type="submit"
                    class="flex justify-center focus:ring-4 focus:outline-none focus:ring-green-300 w-full px-4 py-3 text-sm bg-green-500 hover:bg-green-600 font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
