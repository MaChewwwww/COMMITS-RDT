@extends('settings.index')

@section('profile_content')
    <!--Details-->
    <div class="grid gap-6 mb-4 md:grid-cols-4 mt-4 px-3">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First name</label>
            <input type="text" id="first_name"
                class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                value="{{ $authenticatedUser->first_name }}" disabled />
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last name</label>
            <input type="text" id="first_name"
                class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                value="{{ $authenticatedUser->last_name }}" disabled />
        </div>
    </div>

    <div class="grid gap-6 mb-10 md:grid-cols-4 px-3">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                        <path
                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                    </svg>
                </div>
                <input type="text" id="first_name"
                    class="bg-gray-50 border border-gray-300 cursor-not-allowed text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                    value="{{ $authenticatedUser->email }}" disabled />
            </div>
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
            <input type="text" id="first_name"
                class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                value="{{ $authenticatedUser->role }}" disabled />
        </div>
    </div>

    <div class="grid gap-6 mb-10 md:grid-cols-5 px-3">
        <button type="submit" onclick="showModal()"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-2 py-2.5 text-center">Edit
            Profile</button>
    </div>

    <!-- Edit Profile Details Modal -->
    <div id="editProfileModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 opacity-0 transition-opacity duration-300 ease-out">
        <!-- Modal content -->
        <div
            class="relative p-4 w-full max-w-2xl h-full md:h-auto transform scale-95 transition-transform duration-300 ease-out bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t sm:mb-5">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Profile Details
                </h3>
                <button type="button" onclick="hideModal()"
                    class="text-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 bg-gray-200 hover:bg-gray-300 hover:text-gray-900 rounded-full text-sm p-2 ml-auto inline-flex items-center"
                    data-modal-toggle="editProfileModal">
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
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $authenticatedUser->id }}" name="user_id">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">First name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="firstname" id="firstname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            placeholder="Enter first name" value="{{ $authenticatedUser->first_name }}" required="">
                    </div>
                    <div>
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Last name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="lastname" id="lastname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            placeholder="Enter last name" value="{{ $authenticatedUser->last_name }}" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email address <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:outline-none focus:ring-blue-500 block w-full p-2.5"
                            placeholder="Enter your email address" value="{{ $authenticatedUser->email }}" required>
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <input type="text" name="role" id="role"
                            class="bg-gray-50 border border-gray-300 cursor-not-allowed text-gray-500 text-sm rounded-lg block w-full p-2.5"
                            value="{{ $authenticatedUser->role }}" disabled>
                    </div>
                </div>
                <div class="flex items-center justify-end w-full gap-3 mt-6">
                    <button type="button" onclick="hideModal()"
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
@endsection

@push('scripts')
    <script>
        function showModal() {
            let modal = document.getElementById("editProfileModal");
            let modalContent = modal.querySelector("div.relative");

            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.remove("opacity-0");
                modalContent.classList.remove("scale-95");
                modalContent.classList.add("scale-100");
            }, 10); // Small delay to trigger animation
        }

        function hideModal() {
            let modal = document.getElementById("editProfileModal");
            let modalContent = modal.querySelector("div.relative");

            modal.classList.add("opacity-0");
            modalContent.classList.remove("scale-100");
            modalContent.classList.add("scale-95");

            setTimeout(() => {
                modal.classList.add("hidden");
            }, 300); // Matches transition duration
        }
    </script>

    @if (session('success_edit'))
        <script>
            Swal.fire({
                title: "Success!",
                text: `{!! session('success_edit') !!}`,
                icon: "success"
            });
        </script>
    @endif

    @if (session('error_edit'))
        <script>
            Swal.fire({
                title: "Error!",
                text: `{!! session('error_edit') !!}`,
                icon: "error"
            });
        </script>
    @endif
@endpush
