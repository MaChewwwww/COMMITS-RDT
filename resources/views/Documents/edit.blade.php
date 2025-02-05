@extends('layouts.app')

@section('content')
<form action="{{ route('documents.update', $excuseLetter->document_id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Spoof the PUT method -->
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
                        <p>Date</p>
                        <input type="date" id="date_today" name="date_today" value="{{ old('date_today', $excuseLetter->date_today) }}"
                            class="p-0 mb-3 ps-1 form-control"
                            style="width: 20%; margin-right: 20px; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        @error('date_today')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Doctor's Name -->
                    <div class="d-flex justify-content-start">
                        <p>Dr.</p>
                        <input type="text" id="doctorName" name="doctorName" value="{{ old('doctorName', $excuseLetter->doctorName) }}"
                            class="p-0 mb-3 ps-1 form-control"
                            style="width: 50%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        <p>Address including City, State, and Zip Code</p>
                    </div>
                    @error('doctorName')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <!-- Doctor's Address Input -->
                    <div>
                        <input type="text" id="address" name="address" value="{{ old('address', $excuseLetter->address) }}"
                            class="p-0 mb-3 form-control"
                            style="width: 65%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-5 d-flex justify-content-start">
                        <p>Phone number:</p>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $excuseLetter->phone_number) }}"
                            class="p-0 mb-3 ps-1 form-control"
                            style="width: 20%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Date Input -->
                    <div class="d-flex justify-content-start">
                        <p>Date:</p>
                        <input type="date" id="date" name="date" value="{{ old('date', $excuseLetter->date) }}"
                            class="p-0 mb-3 ps-1 form-control"
                            style="width: 20%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Patient's information -->
                    <div class="d-flex justify-content-start">
                        <p>Patient's Name</p>
                        <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name', $excuseLetter->patient_name) }}"
                            class="p-0 mb-3 ps-1 form-control"
                            style="width: 50%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        @error('patient_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <p>Excuse for</p>
                    </div>
                    <div class="d-flex justify-content-start">
                        <input type="text" id="excuse_for" name="excuse_for" value="{{ old('excuse_for', $excuseLetter->excuse_for) }}"
                            class="p-0 mb-3 form-control"
                            style="width: 60%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        <p>Cause (injury, illness, etc.)</p>
                    </div>
                    <div>
                        <input type="text" id="cause" name="cause" value="{{ old('cause', $excuseLetter->cause) }}"
                            class="p-0 mb-3 form-control"
                            style="width: 75%; border-style: none; border-bottom: 1px solid black; border-radius: 0px" required>
                        @error('cause')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
        <a href="{{ route('documents.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
