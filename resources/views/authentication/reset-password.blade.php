@extends('layouts.guest-layout')

@section('guest_content')
    <div class="bg-[#D9D9D9] bg-opacity-80 p-8 flex flex-col rounded-3xl items-center justify-center">
        <div class="flex flex-row items-start w-full">
            <p class="text-lg font-bold">Reset Password</p>
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="flex flex-col mt-4 gap-y-2">
                    {{-- Email field --}}
                    <div class="flex flex-row space-x-1">
                        <label for="email" class="text-xs font-medium text-gray-800">Email</label>
                        <span class="text-red-500">*</span>
                    </div>
                    <input type="email" name="email" placeholder="Enter your email" class="w-[300px] text-xs outline-none py-3 border-2 border-gray-500 focus:border-red-900 rounded-xl p-2">
                    {{-- Password field --}}
                    <div class="flex flex-row space-x-1">
                        <label for="password" class="text-xs font-medium text-gray-800">Password</label>
                        <span class="text-red-500">*</span>
                    </div>
                    <div class="relative">
                        <input name="password" type="password" id="passwordID" placeholder="Enter your new password" class="pr-10 w-[300px] text-xs outline-none py-3 border-2 border-gray-500 focus:border-red-900 rounded-xl p-2">
                        <button type="button" id="togglePassword" class="absolute right-3 top-3">
                            <svg id="eyeIconPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    {{-- Confirm password field --}}
                    <div class="flex flex-row space-x-1">
                        <label for="confirmPassword" class="text-xs font-medium text-gray-800">Confirmation Password</label>
                        <span class="text-red-500">*</span>
                    </div>
                    <div class="relative">
                        <input name="password_confirmation" type="password" id="confirmPasswordID" placeholder="Confirm new password" class="pr-10 w-[300px] text-xs outline-none py-3 border-2 border-gray-500 focus:border-red-900 rounded-xl p-2">
                        <button type="button" id="toggleConfirmPassword" class="absolute right-3 top-3">
                            <svg id="eyeIconConfirmPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    {{-- hidden token field contained the value of secret $token --}}
                    <input type="hidden" name="token" value="{{ $token }}"> {{-- change the value to token variable --}}
            </div>
            <div class="flex flex-row justify-end w-full mt-5 gap-x-5">
                <a href="{{ route('login') }}">
                    <button type="button" class="px-4 py-2 text-sm text-white bg-red-500 rounded-full">Cancel</button>
                </a>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-full">Confirm</button>
            </div>
        </form>
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
    document.getElementById('togglePassword').addEventListener('click', () => {
        togglePassword('passwordID', 'eyeIconPassword');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', () => {
        togglePassword('confirmPasswordID', 'eyeIconConfirmPassword');
    });
</script>
@endsection