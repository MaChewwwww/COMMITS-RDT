@extends('layouts.app-layout')

@section('content')

<a href="{{ route('documents.index', $id) }}" class="btn">Back</a>
<a href="{{ route('documents.edit', $id) }}" class="btn">Edit Document</a>
    <div class="container-sm">
        <!-- Page 1 -->
        <div class="card ps-5 pe-5">
            <!-- Start of header -->
            <div class="container pt-5 pb-5 text-center d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/puplogo.png') }}" alt="Avatar" style="width:13%">
                <div class="ms-5 d-flex flex-column justify-content-center align-items-center">
                    <div class="mt-5">
                        <h4 style="font-family: 'Times New Roman', Times, serif; line-height: 0.3;">Republic of the Philippines</h4>
                        <h4 style="font-family: 'Times New Roman', Times, serif; line-height: 1;">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</h4>
                        <h4 style="font-family: 'Times New Roman', Times, serif; line-height: 0;">Quezon City</h4>
                    </div>
                    <div>
                        <h3 style="font-family: 'Times New Roman'; font-weight: bold; margin-top: 20px;">EXCUSE LETTER</h3>
                    </div>
                </div>
            </div>
            <!-- End of header -->
            <!-- Start of body -->
            <div class="ps-5 pe-5">
                <div class="ms-5 justify-center-center">
                    <!-- Date -->
                    <div class="d-flex justify-content-end align-items-center">
                        <p style="margin-right: 20px;">Date:</p>
                        <p style="width: 20%; border-bottom: 1px solid black;">{{ $excuseletter->date_today }}</p>
                    </div>
                    <!-- Doctor's Name -->
                    <div class="d-flex justify-content-start">
                        <p>Dr.</p>
                        <p style="width: 50%; border-bottom: 1px solid black;">{{ $excuseletter->doctorName }}</p>
                        <p>Address including City, State, and Zip Code</p>
                    </div>
                    <!-- Doctor's Address -->
                    <div>
                        <p style="width: 65%; border-bottom: 1px solid black;">{{ $excuseletter->address }}</p>
                    </div>
                    <!-- Phone Number -->
                    <div class="mt-5 d-flex justify-content-start">
                        <p>Phone number:</p>
                        <p style="width: 20%; border-bottom: 1px solid black;">{{ $excuseletter->phone_number }}</p>
                    </div>
                    <!-- Date -->
                    <div class="d-flex justify-content-start">
                        <p>Date:</p>
                        <p style="width: 20%; border-bottom: 1px solid black;">{{ $excuseletter->date }}</p>
                    </div>
                    <!-- Patient's Information -->
                    <div class="d-flex justify-content-start">
                        <p>Patient's Name:</p>
                        <p style="width: 50%; border-bottom: 1px solid black;">{{ $excuseletter->patient_name }}</p>
                        <p>Excuse for:</p>
                    </div>
                    <div class="d-flex justify-content-start">
                        <p style="width: 60%; border-bottom: 1px solid black;">{{ $excuseletter->excuse_for }}</p>
                        <p>Cause (injury, illness, etc.):</p>
                    </div>
                    <div>
                        <p style="width: 75%; border-bottom: 1px solid black;">{{ $excuseletter->cause }}</p>
                    </div>
                    <!-- Clinic Physician's Signature -->
                    <div class="container text-end">
                        <div class="col">
                            <div class="d-flex justify-content-end me-3">
                                <p>__________________________</p>
                            </div>
                            <div class="col-md-6 offset-md-5">
                                <p>Clinic Physician</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of body -->
        <!-- Page 2 -->
        <div class="card ps-5 pe-5">
            <!-- Start of header -->
            <div class="container pt-5 pb-5 text-center d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/puplogo.png') }}" alt="Avatar" style="width:13%">
                <div class="ms-5 d-flex flex-column justify-content-center align-items-center">
                    <div class="mt-5">
                        <h4 style="font-family: 'Times New Roman', Times, serif; line-height: 0.3;">Republic of the Philippines</h4>
                        <h4 style="font-family: 'Times New Roman', Times, serif; line-height: 1;">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</h4>
                        <h4 style="font-family: 'Times New Roman', Times, serif; line-height: 0;">Quezon City</h4>
                    </div>
                    <div>
                        <h3 style="font-family: 'Times New Roman'; font-weight: bold; margin-top: 20px;">EXCUSE LETTER</h3>
                    </div>
                </div>
            </div>
            <!-- End of header -->
            <!-- Start of body -->
            <div class="ps-5 pe-5">
                <div class="ms-5 justify-center-center">
                    <!-- Date -->
                    <div class="d-flex justify-content-end align-items-center">
                        <p style="margin-right: 20px;">Date:</p>
                        <p style="width: 20%; border-bottom: 1px solid black;">{{ $excuseletter->date_today }}</p>
                    </div>
                    <!-- Doctor's Name -->
                    <div class="d-flex justify-content-start">
                        <p>Dr.</p>
                        <p style="width: 50%; border-bottom: 1px solid black;">{{ $excuseletter->doctorName }}</p>
                        <p>Address including City, State, and Zip Code</p>
                    </div>
                    <!-- Doctor's Address -->
                    <div>
                        <p style="width: 65%; border-bottom: 1px solid black;">{{ $excuseletter->address }}</p>
                    </div>
                    <!-- Phone Number -->
                    <div class="mt-5 d-flex justify-content-start">
                        <p>Phone number:</p>
                        <p style="width: 20%; border-bottom: 1px solid black;">{{ $excuseletter->phone_number }}</p>
                    </div>
                    <!-- Date -->
                    <div class="d-flex justify-content-start">
                        <p>Date:</p>
                        <p style="width: 20%; border-bottom: 1px solid black;">{{ $excuseletter->date }}</p>
                    </div>
                    <!-- Patient's Information -->
                    <div class="d-flex justify-content-start">
                        <p>Patient's Name:</p>
                        <p style="width: 50%; border-bottom: 1px solid black;">{{ $excuseletter->patient_name }}</p>
                        <p>Excuse for:</p>
                    </div>
                    <div class="d-flex justify-content-start">
                        <p style="width: 60%; border-bottom: 1px solid black;">{{ $excuseletter->excuse_for }}</p>
                        <p>Cause (injury, illness, etc.):</p>
                    </div>
                    <div>
                        <p style="width: 75%; border-bottom: 1px solid black;">{{ $excuseletter->cause }}</p>
                    </div>
                    <!-- Clinic Physician's Signature -->
                    <div class="container text-end">
                        <div class="col">
                            <div class="d-flex justify-content-end me-3">
                                <p>__________________________</p>
                            </div>
                            <div class="col-md-6 offset-md-5">
                                <p>Clinic Physician</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of body -->
    </div>
@endsection
