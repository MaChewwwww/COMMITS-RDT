@extends('layouts.profile')

@section('content')

    {{-- JQuery CDN for real time change profile --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- Add this PHP block at the top --}}
    @php
        $defaultImage = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2NjYyI+PHBhdGggZD0iTTEyIDJDNi40OCAyIDIgNi40OCAyIDEyczQuNDggMTAgMTAgMTAgMTAtNC40OCAxMC0xMFMxNy41MiAyIDEyIDJ6bTAgM2MxLjY2IDAgMyAxLjM0IDMgM3MtMS4zNCAzLTMgMy0zLTEuMzQtMy0zIDEuMzQtMyAzLTN6bTAgMTQuMmMtMi41IDAtNC43MS0xLjI4LTYtMy4yMi4wMy0xLjk5IDQtMy4wOCA2LTMuMDggMS45OSAwIDUuOTcgMS4wOSA2IDMuMDgtMS4yOSAxLjk0LTMuNSAzLjIyLTYgMy4yMnoiLz48L3N2Zz4=';
        $profileImage = $Data->profile_image ? asset('uploads/users/'.$Data->profile_image) : $defaultImage;
    @endphp

    <div class="container mx-auto">
        <div class="bg-white w-full h-full">

        </div>
    </div>

    {{-- <div class="flex flex-col "> --}}
        {{-- <div class ="flex flex-row gap-3 pb-6"> --}}
            {{-- <a href="{{ route('patients') }}"> {{-- change this to route of dashboard and also make a validation where it will
                ask user if they want to really go back if there is any unsaved changes--}}
                {{-- <button> --}}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </button>
            </a>
            <p class="text-lg">Back</p>
        </div>
        <div class="flex flex-row"> --}}
            {{-- @include('components.profileSideBar') sidebar --}}
            {{-- main content --}}
            {{-- <div class="flex flex-col flex-1 w-2/3 bg-white gap-y-5">
                <div class="flex flex-row item-center gap-x-5">
                    <img id="profileImage" src="{{ $profileImage }}"
                    alt="profile picture" height="150" width="150" class="object-cover rounded-full cursor-pointer">
                    <div class="flex flex-col pt-5">
                        <div class="flex flex-row gap-x-3">
                            <p class="text-3xl font-semibold">{{ $Data->first_name }}</p>
                            <p class="text-3xl font-semibold">{{ $Data->last_name }}</p>
                        </div>
                        <div class="flex flex-row">
                            <p class="text-xs text-gray-500">{{ $Data->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row">
                    <button type="button" onclick=openEditProfileModal() class="px-8 py-2 text-white bg-green-600 rounded-xl ">Edit Profile</button>
                </div> --}}
                <!-- Modal for Image Preview -->
                {{-- <div id="imageModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-70">
                    <div class="relative">
                        <img id="modalImage" src="" alt="Image Preview" class="max-w-full max-h-[80vh] w-[80vh] h=[80vh] object-contain">
                        <button type="button" id="closeModal" class="absolute px-2 py-1 text-white bg-red-600 rounded-full top-2 right-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div> --}}
                {{-- Edit profile modal --}}
                {{-- <div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50 h-[100vh]">
                    <div class="bg-white p-6 rounded-lg flex flex-col shadow-lg max-w-auto max-w-4xl mx-4 sm:mx-auto overflow-y-auto max-h-[80vh] relative">
                        <form method="POST" action="{{ route('profile.updateProfile') }}" enctype="multipart/form-data" class="flex flex-col gap-y-5">
                            @csrf
                            <div class="flex flex-col">
                                <p class="text-lg font-medium">Edit Profile</p>
                                <p class="text-xs font-medium text-gray-600">Update your profile information</p>
                            </div> --}}
                            {{-- Edit form --}}
                            {{-- <div class="flex flex-row">
                                <p class="text-sm font-medium text-gray-600">Photo</p>
                            </div>
                            <div class="flex flex-row item-center gap-x-5">
                                <img id="editProfileImage" src="{{ $profileImage }}"
                                data-original-src="{{ $profileImage }}" alt="profile picture" height="100" width="100" class="object-cover rounded-full">
                                <button id="uploadBtn" class="self-center px-6 py-2 text-white bg-green-600 rounded-xl">Choose photo</button>
                                <input type="file" name="profile_image" id="imageInput" class="hidden">
                            </div>
                            <div class="flex flex-row gap-x-5">
                                <div class="flex flex-col">
                                    <div class="flex flex-row gap-x-1">
                                        <label for="firstName" class="block text-sm font-small">First Name</label><span class="text-red-500">*</span>
                                    </div>
                                    <input required name="first_name" value="{{ $Data->first_name }}" id="firstName" class="p-2 pl-5 text-xs border border-gray-400 resize-none rounded-2xl focus:border-red-800 focus:outline-none"></input>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex flex-row gap-x-1">
                                        <label for="lastName" class="block text-sm font-small">Last Name</label><span class="text-red-500">*</span>
                                    </div>
                                    <input required name="last_name" value="{{ $Data->last_name }}" id="lastName" class="p-2 pl-5 text-xs border border-gray-400 resize-none rounded-2xl focus:border-red-800 focus:outline-none"></input>
                                </div>
                            </div>
                            @if(session('error'))
                                <p class="text-sm text-red-500">{{ session('error') }}</p>
                            @endif --}}
                            {{-- Action buttons --}}
                            {{-- <div class="flex flex-row justify-end gap-x-2">
                                <button type="button" onclick=closeEditProfileModal() class="px-8 py-1 text-white bg-red-600 rounded-xl">Cancel</button>
                                <button type="submit" class="px-8 py-2 text-white bg-green-600 rounded-xl">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        // for upload profile button
        const uploadBtn = document.getElementById('uploadBtn');
        const fileInput = document.getElementById('imageInput');
        const fileName = document.getElementById('fileName');

        uploadBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent form submission or page reload
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                fileName.textContent = `Selected: ${file.name}`;
            } else {
                fileName.textContent = '';
            }
        });

        // Open modal for edit profile
        function openEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.classList.remove('hidden');
        }

        function closeEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.classList.add('hidden');

            const editProfileImage = document.getElementById('editProfileImage');
            // Reset the image src using the data attribute
            editProfileImage.src = editProfileImage.dataset.originalSrc;

            // Reset input fields to their original values
            document.getElementById('firstName').value = "{{ $Data->first_name }}";
            document.getElementById('lastName').value = "{{ $Data->last_name }}";
        }

        // Modal for Image Preview
        const profileImage = document.getElementById('profileImage');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.getElementById('closeModal');

        // Show modal with enlarged image
        profileImage.addEventListener('click', () => {
            modalImage.src = profileImage.src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        // Close modal on close button click
        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Close modal when clicking outside the image
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });

    </script>

    {{-- Real time change profile --}}
    <script type="text/javascript">
    $(document).ready(function(){
        $('#imageInput').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#editProfileImage').attr('src', e.target.result);
                $('#modalImage').attr('src', e.target.result); // Update modal image as well
            }
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
    </script>

@endsection
