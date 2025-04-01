@extends('layouts.guest-layout')

@section('guest_content')
    <div class="p-6 space-y-6">
        <div class="text-center">
            <!-- Placeholder for logo -->
            <div
                class="mx-auto h-16 w-16 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full flex items-center justify-center shadow-md overflow-hidden">
                <img src="{{ asset('images/prms-logo 2.jpg') }}" alt="Logo" class="h-full w-full object-cover">
            </div>

            <h1 class="mt-6 text-xl font-semibold text-gray-900">
                Forgot Password
            </h1>
            <p class="mt-2 text-sm text-gray-600">
                Enter your registered email address below
            </p>
        </div>

        <form class="space-y-4 md:space-y-6" id="form" action="{{ route('password.request') }}" method="post">
            @csrf
            {{-- Email --}}
            <div class="mt-8 input-control">
                <div class="inline-flex items-center space-x-1">
                    <x-input-label for="email" value="Email" />
                    <span class="text-red-500">*</span>
                </div>
                <x-input-textfield id="email" name="email" class="mb-1" placeholder="Enter your email" />
                @if (session('status'))
                    <p class="mt-2 text-sm text-green-500">{{ session('status') }}</p>
                @endif

                {{-- Error message for invalid credentials --}}
                @error('email')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-row justify-center w-full mt-5 gap-x-2">
                <a href="{{ route('login') }}">
                    <button type="button"
                        class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</button>
                </a>
                <button type="submit"
                    class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send
                    Email Verification</button>
            </div>
        </form>
    </div>
@endsection
