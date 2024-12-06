{{-- ADAPT GUEST LAYOUT LODATED IN (resources/views/layouts/guest-layout.blade.php) --}}

@extends('layouts.guest-layout')

@section('guest-content')

    <div class="bg-gray-500 flex items-center justify-center text-center">
        <form action="" method="">
            @csrf

            <div class="">
                <label for="email">Email <span class="text-red-500">*</span></label>

            </div>
        </form>
    </div>

@endsection
