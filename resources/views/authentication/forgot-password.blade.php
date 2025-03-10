@extends('layouts.guest-layout')

@section('guest_content')

    <div class="bg-white bg-opacity-90 flex flex-col w-[500px] h-auto py-14 rounded-xl items-center justify-center">
        <h1 class=" text-xl font-semibold">Forgot Password</h1>
        <p class="mt-2 text-base text-gray-500">Enter your registered email address below.</p>
        <form method="POST" action="{{ route('password.request') }}" class="w-full px-14">
            @csrf
            <div class="flex flex-col mt-10 gap-y-1">
                    <div class="flex flex-row space-x-1">
                        <label class="text-sm font-medium text-gray-800 ml-2">Email</label>
                        <span class="text-red-500">*</span>
                    </div>
                    <input name="email" type="email" placeholder="Enter your email" class="w-full text-xs outline-none py-3 border-2 border-gray-300 focus:border-blue-500 rounded-xl p-2">
            </div>
            <div class="flex flex-row justify-center w-full mt-5 gap-x-2">
                <a href="{{ route('login') }}">
                    <button type="button" class="px-4 py-3 text-sm text-white bg-red-500 rounded-xl w-44">Cancel</button>
                </a>
                <button type="submit" class="px-4 py-3 text-sm text-white bg-green-600 rounded-xl w-44">Send Verification</button>
            </div>
        </form>
    </div>

@endsection
