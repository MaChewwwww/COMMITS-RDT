@extends('layouts.profile')

@section('content')
    <div class="flex flex-col p-6 bg-white">
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
            <div class="flex flex-col gap-y-5">
                <div class="flex flex-col">
                    <p class="text-lg font-medium">Change Password</p>
                    <p class="text-xs font-medium text-gray-600">Protect your profile with a new password</p>
                </div>
                <form method="POST" action="{{ route('profile.updatePassword') }}" class="flex flex-col gap-y-3">
                    @csrf
                    <div class="flex flex-row items-center gap-x-5">
                        <div class="flex flex-row gap-x-3">
                            <div class="relative flex flex-col">
                                <div class="flex flex-row gap-x-1">
                                    <label for="currentPassword" class="block text-xs font-small">Current password</label><span class="text-red-500">*</span>
                                </div>
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
                                <div class="flex flex-row gap-x-1">
                                    <label for="newPassword" class="block text-xs font-small">New password</label><span class="text-red-500">*</span>
                                </div>
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
                    </div>
                    @if(session('error'))
                        <p class="text-sm text-red-500">{{ session('error') }}</p>
                    @endif
                    @if(session('success'))
                        <p class="text-sm text-green-500">{{ session('success') }}</p>
                    @endif
                    <div class="flex flex-col items-start justify-center w-full">
                        <button type="submit" class="px-8 py-2 text-white bg-green-600 rounded-xl ">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
    </script>
@endsection