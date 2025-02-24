@extends('layouts.guest-layout')

@section('guest_content')
        
    <div class="bg-[#D9D9D9] bg-opacity-80 p-8 flex flex-col rounded-3xl items-center justify-center">
        <div class="flex flex-row items-start w-full">
            <p class="text-lg font-bold">Forgot Password</p>
        </div>
        <form method="POST" action="{{ route('password.request') }}">
            @csrf
            <div class="flex flex-col mt-4 gap-y-2">
                    <div class="flex flex-row space-x-1">
                        <label class="text-xs font-medium text-gray-800">Email</label>
                        <span class="text-red-500">*</span>
                    </div>
                    <input name="email" type="email" placeholder="Enter your email" class="w-[300px] text-xs outline-none py-3 border-2 border-gray-500 focus:border-red-900 rounded-xl p-2">
            </div>
            <div class="flex flex-row justify-end w-full mt-5 gap-x-5">
                <a href="{{ route('login') }}">
                    <button type="button" class="px-4 py-2 text-sm text-white bg-red-500 rounded-full">Cancel</button>
                </a>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-full">Send Verification</button>
            </div>
        </form>
    </div>

@endsection