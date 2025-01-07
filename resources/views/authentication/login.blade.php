@extends('layouts.guest-layout')

@section('guest_content')
    <div class="bg-[#D9D9D9] bg-opacity-80 p-8 flex flex-col rounded-3xl items-center justify-center w-[423px] h-[490px]">
        <div class="flex flex-col items-center mt-5">
            <img class="w-[60px] h-[60px]" src="{{ asset('src/images/logo.png') }}" alt="logo">
            <h2 class="mt-2 text-sm font-bold">Patient Record Management System</h2>
        </div>

        <form id="form" action="{{ route('login') }}" method="post" class="flex flex-col items-center">
            @csrf

            {{-- Email --}}
            <div class="mt-8 input-control">
                <div class="inline-flex items-center space-x-1">
                    <x-input-label class="ml-1 text-xs font-medium text-gray-800" for="email" value="Email" />
                    <span class="text-red-500">*</span>
                </div>
                <x-input-textfield id="email" name="email" class="block mt-1 border-2"
                    placeholder="Enter your email" />
                <div class="mt-2 ml-1 text-xs text-red-500 error"></div> <!-- Error div for email -->
            </div>

            {{-- Password --}}
            <div class="mt-2">
                <div class="inline-flex items-center space-x-1">
                    <x-input-label class="ml-1 text-xs font-medium text-gray-800" for="password" value="Password" />
                    <span class="text-red-500">*</span>
                </div>
                <div class="relative input-control">
                    <x-input-textfield id="password" type="password" name="password" class="block mt-1 border-2"
                        placeholder="Enter your password" />
                    <span id="password-hidden"
                        class="absolute text-gray-600 transform -translate-y-1/2 cursor-pointer right-3 top-1/2">
                        <i class="text-sm fas fa-eye-slash"></i>
                    </span>
                    <span id="password-show"
                        class="absolute hidden text-gray-600 transform -translate-y-1/2 cursor-pointer right-3 top-1/2">
                        <i class="text-sm fas fa-eye"></i>
                    </span>
                </div>
                <div id="password-error" class="block mt-2 ml-1 text-xs text-red-500 w-80"></div>
            </div>

            {{-- Forgot Password --}}
            <div class="flex justify-end w-full mt-2">
                <a class="text-xs font-normal text-gray-700 underline hover:text-yellow-600" href="#">Forgot
                    password?</a>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="bg-[#3CAA38] w-[260px] h-[42px] rounded-3xl mt-8 mb-5 text-white text-sm flex justify-center items-center">
                Login
            </button>
        </form>

    </div>
@endsection
