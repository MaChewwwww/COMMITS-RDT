@extends('layouts.profile')

@section('content')

{{-- JQuery CDN for real time change profile --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

{{-- Add this PHP block at the top --}}
@php
    $defaultImage = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2NjYyI+PHBhdGggZD0iTTEyIDJDNi40OCAyIDIgNi40OCAyIDEyczQuNDggMTAgMTAgMTAgMTAtNC40OCAxMC0xMFMxNy41MiAyIDEyIDJ6bTAgM2MxLjY2IDAgMyAxLjM0IDMgM3MtMS4zNCAzLTMgMy0zLTEuMzQtMy0zIDEuMzQtMyAzLTN6bTAgMTQuMmMtMi41IDAtNC43MS0xLjI4LTYtMy4yMi4wMy0xLjk5IDQtMy4wOCA2LTMuMDggMS45OSAwIDUuOTcgMS4wOSA2IDMuMDgtMS4yOSAxLjk0LTMuNSAzLjIyLTYgMy4yMnoiLz48L3N2Zz4=';
    $profileImage = $Data->profile_image ? asset('uploads/users/'.$Data->profile_image) : $defaultImage;
@endphp

<div class="flex flex-col p-6 bg-white w-full">
    <div class ="flex flex-row gap-3 pb-6">
        <a href="{{ route('patients') }}"> {{-- change this to route of dashboard and also make a validation where it will
            ask user if they want to really go back if there is any unsaved changes--}}
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>
        </a>
        <p class="text-lg">Back</p>
    </div>
    <div class="flex flex-row">
        @include('components.profileSideBar') {{-- sidebar --}}
        {{-- main content --}}
        <div class="flex flex-col flex-1 w-2/3 bg-white gap-y-2">
            <div class="flex flex-col">
                <p class="text-lg font-medium">Edit Profile</p>
                <p class="text-xs font-medium text-gray-600">Update your profile information</p>
            </div>
            <div class="flex flex-row pt-4">
                <p class="text-sm font-medium text-gray-600">Photo</p>
            </div>
            <form method="POST" action="{{ route('profile.updateProfile') }}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-row item-center gap-x-5">
                    <img id="profileImage" src="{{ $profileImage }}"
                    alt="profile picture" height="100" width="100" class="object-cover rounded-full">
                    <button id="uploadBtn" class="self-center px-6 py-1 text-white bg-green-600 rounded-full">Choose photo</button>
                    <input type="file" name="profile_image" id="imageInput" class="hidden">
                </div>
                <!-- Modal for Image Preview -->
                <div id="imageModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-70">
                    <div class="relative">
                        <img id="modalImage" src="" alt="Image Preview" class="max-w-full max-h-[80vh] w-[80vh] h=[80vh] object-contain">
                        <button type="button" id="closeModal" class="absolute px-2 py-1 text-white bg-red-600 rounded-full top-2 right-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                              </svg>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col w-96 gap-y-5">
                    <div class="flex flex-row pt-4 gap-x-5">
                        <div class="flex flex-col">
                            <label for="firstName" class="block mb-1 text-xs font-small">First name</label>
                            <input name="first_name" value="{{ $Data->first_name }}" id="firstName" class="p-2 pl-5 text-xs border border-gray-400 resize-none rounded-2xl focus:border-red-800 focus:outline-none"></input>
                        </div>
                        <div class="flex flex-col">
                            <label for="lastName" class="block mb-1 text-xs font-small">Last name</label>
                            <input name="last_name" value="{{ $Data->last_name }}" id="lastName" class="p-2 pl-5 text-xs border border-gray-400 resize-none rounded-2xl focus:border-red-800 focus:outline-none"></input>
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <button type="submit" class="self-center px-8 py-1 ml-auto text-white bg-green-600 rounded-full">Change</button>
                    </div>
                </div>
            </form>
            <hr class="h-px my-8 bg-gray-200 border-0 rounded-lg w-96 dark:bg-gray-400">
            <div class="flex flex-col">
                <p class="text-lg font-medium">Change Password</p>
                <p class="text-xs font-medium text-gray-600">Protect your profile with a new password</p>
            </div>
            <form method="POST" action="{{ route('profile.updatePassword') }}">
                @csrf
                <div class="flex flex-row items-center gap-x-5">
                    <div class="flex flex-col pt-3 gap-y-3">
                        <div class="relative flex flex-col">
                            <label for="currentPassword" class="block mb-1 text-xs font-small">Current password</label>
                            <div class="relative w-48">
                                <input name="currentPassword" id="oldPasswordID" type="password"
                                    class="w-full p-2 pl-5 pr-10 text-xs border border-gray-400 resize-none rounded-2xl focus:border-red-800 focus:outline-none"></input>

                                <!-- SVG Icon inside the textarea container -->
                                <button type="button" id="toggleOldPassword" class="absolute right-2 top-2">
                                    <svg id="eyeIconOld" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="relative flex flex-col">
                            <label for="newPassword" class="block mb-1 text-xs font-small">New password</label>
                            <div class="relative w-48">
                                <input name="newPassword" id="newPasswordID" type="password"
                                    class="w-full p-2 pl-5 pr-10 text-xs border border-gray-400 resize-none rounded-2xl focus:border-red-800 focus:outline-none"></input>
                                <!-- SVG Icon inside the input container -->
                                <button type="button" id="toggleNewPassword" class="absolute right-2 top-2">
                                    <svg id="eyeIconNew" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-start justify-center w-full h-full">
                        <button type="submit" class="px-8 py-1 text-white bg-green-600 rounded-full ">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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

    // for toggle password visibility
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        // Toggle icon color for visual feedback
        eyeIcon.classList.toggle('text-gray-400');
        eyeIcon.classList.toggle('text-red-500');
    }

    // Event Listeners for Both Inputs
    document.getElementById('toggleOldPassword').addEventListener('click', () => {
        togglePassword('oldPasswordID', 'eyeIconOld');
    });

    document.getElementById('toggleNewPassword').addEventListener('click', () => {
        togglePassword('newPasswordID', 'eyeIconNew');
    });

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
            $('#profileImage').attr('src', e.target.result);
            $('#modalImage').attr('src', e.target.result); // Update modal image as well
        }
        if (e.target.files[0]) {
            reader.readAsDataURL(e.target.files[0]);
        }
    });
});
</script>

@endsection
