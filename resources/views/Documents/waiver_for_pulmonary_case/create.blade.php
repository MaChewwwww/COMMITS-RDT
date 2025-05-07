@extends('layouts.app-layout')

@section('title', 'Waver for Pulmonary Case Form')

@section('content')

    <!-- Buttons (Optional for print view, you can hide them when printing) -->
    <div class="flex space-x-10 justify-between mb-5">
        <button class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400 flex items-center space-x-2"
            onclick="goBack()" aria-label="Go Back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path
                    d="M3.82843 6.9999H16V8.9999H3.82843L9.1924 14.3638L7.7782 15.778L0 7.9999L7.7782 0.22168L9.1924 1.63589L3.82843 6.9999Z"
                    fill="black" />
            </svg>
            <span>Back</span>
        </button>

        <div>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 mr-2" onclick="openEditForm()"
                aria-label="Edit Form">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                    <path
                        d="M3.41421 13.9706L13.5563 3.82843L12.1421 2.41421L2 12.5564V13.9706H3.41421ZM4.24264 15.9706H0V11.7279L11.435 0.29289C11.8256 -0.09763 12.4587 -0.09763 12.8492 0.29289L15.6777 3.12132C16.0682 3.51184 16.0682 4.14501 15.6777 4.53553L4.24264 15.9706ZM0 17.9706H18V19.9706H0V17.9706Z"
                        fill="white" />
                </svg>
            </button>
            <button class="px-4 py-2 bg-[#7A0019] text-white rounded-md hover:bg-[#7A0019] hover:bg-opacity-80 mr-5"
                onclick="printWaiver()" aria-label="Print the form">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 25 20" fill="none">
                    <path
                        d="M18.75 0.000488281C19.4404 0.000488281 20 0.448208 20 1.00049V5.00049H23.75C24.4404 5.00049 25 5.44821 25 6.00049V16.0005C25 16.5528 24.4404 17.0005 23.75 17.0005H20V19.0005C20 19.5528 19.4404 20.0005 18.75 20.0005H6.25C5.55965 20.0005 5 19.5528 5 19.0005V17.0005H1.25C0.55965 17.0005 0 16.5528 0 16.0005V6.00049C0 5.44821 0.55965 5.00049 1.25 5.00049H5V1.00049C5 0.448208 5.55965 0.000488281 6.25 0.000488281H18.75ZM17.5 15.0005H7.5V18.0005H17.5V15.0005ZM22.5 7.00049H2.5V15.0005H5V14.0005C5 13.4482 5.55965 13.0005 6.25 13.0005H18.75C19.4404 13.0005 20 13.4482 20 14.0005V15.0005H22.5V7.00049ZM7.5 8.00049V10.0005H3.75V8.00049H7.5ZM17.5 2.00049H7.5V5.00049H17.5V2.00049Z"
                        fill="white" />
                </svg>
            </button>
        </div>
    </div>

    <div class="container mx-auto bg-white md:py-20 md:px-20 w-[90%] md:w-[70%] lg:w-[70%]">
        <div class="page">
            <div class="container">
                <div class="flex items-center justify-center mb-5">
                    <div class="mr-5">
                        <img src="{{ asset('Logo_image/logopup.png') }}" alt="Logo" class="w-28 mb-5">
                    </div>
                    <div class="text-center" style="font-family: 'Times New Roman', serif;">
                        <h1 class="text-sm font-normal">Republic of the Philippines</h1>
                        <h1 class="text-base font-normal">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</h1>
                        <p class="text-sm mb-5">Quezon City</p>
                        <h2 class="text-xl font-semibold">WAIVER PULMONARY CASE</h2>
                    </div>
                </div>
                <div class="text-right my-10 mb-8 font-Arial">
                    <span> <span id="date-placeholder" class="underline-offset-4">Date ___________________</span>
                </div>

                <div class="space-y-4 font-Arial mb-5">

                    <p class="indent-8">
                        I, <span id="name-placeholder" class="underline-offset-4">
                            __________________________________________________________________________</span>
                        student from the College of <span id="school">_____________________________</span>, school year
                        <span id="department">____________________</span>, am aware that as per medical advice from the
                        University Medical Clinic, should submit by myself for
                        follow-up medical check-up on <span id="date">________________________</span> and that
                        additional clearance must be secured prior to the next
                        semester's enrollment.
                    </p>
                </div>

                <div class="flex justify-end p-10">
                    <div class="w-11/30 text-left">
                        <p>_______________________________</p>
                        <p class="text-center">Signature</p>
                    </div>
                </div>

                <div class="flex justify-start p-0">
                    <div class="w-11/30 text-left">
                        <p>Comforme:</p><br>
                        <p>_______________________________</p>
                        <p class="text-center">Parent / Guardian</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Document 2 (duplicate the structure as needed) -->
    <div class="container mx-auto bg-white md:py-20 md:px-20 w-[90%] md:w-[70%] lg:w-[70%]">
        <div class="container2 mt-15">
            <div class="flex items-center justify-center mb-5">
                <div class="mr-5">
                    <img src="{{ asset('Logo_image/logopup.png') }}" alt="Logo" class="w-28 mb-5">
                </div>
                <!-- Center-aligned text block with a serif font -->
                <div class="text-center" style="font-family: 'Times New Roman', serif;">
                    <!-- Republic heading -->
                    <h1 class="text-sm font-normal">Republic of the Philippines</h1>
                    <!-- University heading -->
                    <h1 class="text-base font-normal">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</h1>
                    <!-- Location -->
                    <p class="text-sm mb-5">Quezon City</p>
                    <!-- Medical clearance title -->
                    <h2 class="text-xl font-semibold">WAIVER PULMONARY CASE</h2>
                </div>

            </div>

            <div class="text-right my-10 mb-8 font-Arial">
                <span><span id="date-placeholder2" class="underline-offset-4">Date ____________________</span>
            </div>

            <div class="space-y-4 font-Arial mb-5">
                <p class="indent-8">
                    I, <span id="name-placeholder2" class="underline-offset-4">
                        __________________________________________________________________________</span> student from
                    the College of <span id="school2">_____________________________</span> , school year
                    <span id="department2">____________________</span>, am aware that as per medical advice from the
                    University Medical Clinic, should submit by myself for
                    follow-up medical check-up on
                    <span id="date2">________________________</span> and that additional clearance must be secured prior
                    to the next
                    semester's enrollment.
            </div>

            <div class="flex justify-end p-10">
                <div class="w-11/30 text-left">
                    <p>_______________________________</p>
                    <p class="text-center">Signature</p>
                </div>
            </div>

            <div class="flex justify-start p-0">
                <div class="w-11/30 text-left">
                    <p>Comforme:</p><br>
                    <p>_______________________________</p>
                    <p class="text-center">Parent / Guardian</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    @include('Documents.waiver_for_pulmonary_case.create-form')

@endsection

@push('scripts')
    <script>
        function printWaiver() {
            window.print();
        }

        function goBack() {
            window.location.href = "{{ route('documents.index') }}";
        }

        // Function to close the edit form modal
        function closeEditForm() {
            // const modal = document.getElementById("editFormModal");
            // modal.classList.add("hidden");

            let modal = document.getElementById("editFormModal");
            let modalContent = modal.querySelector("div.relative");

            modal.classList.add("opacity-0");
            modalContent.classList.remove("scale-100");
            modalContent.classList.add("scale-95");

            setTimeout(() => {
                modal.classList.add("hidden");
            }, 300); // Matches transition duration
        }

        // Function to open the edit form modal
        function openEditForm() {
            // const modal = document.getElementById("editFormModal");
            // modal.classList.remove("hidden");

            let modal = document.getElementById("editFormModal");
            let modalContent = modal.querySelector("div.relative");

            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.remove("opacity-0");
                modalContent.classList.remove("scale-95");
                modalContent.classList.add("scale-100");
            }, 10); // Small delay to trigger animation
        }

        let formCount = 1;

        function addForm() {
            formCount++;
            const formContainer1 = document.getElementById("formContainer1");
            formContainer1.classList.remove("hidden");
            if (formCount === 2) {
                document.querySelector("button[onclick='addForm()']").style.display = 'none';
            }
        }

        function validateField(fieldId, errorId) {
            const fieldValue = document.getElementById(fieldId).value;
            const errorElement = document.getElementById(errorId);

            if (!fieldValue) {
                errorElement.classList.remove("hidden");
                return false;
            } else {
                errorElement.classList.add("hidden");
                return true;
            }
        }

        // Function to save the form data
        function saveEdits() {
            let isValid = true;

            // Validate the first form fields
            isValid &= validateField("editDate", "editDateError");
            isValid &= validateField("editPatientName", "editPatientNameError");
            isValid &= validateField("editschoolname", "editschoolnameError");
            isValid &= validateField("schoolyear", "schoolyearError");
            isValid &= validateField("editDateefollowcheck", "editDateefollowcheckError");

            if (!isValid) return; // Stop if first form is invalid

            // Capture values for the first form
            const editDate = document.getElementById("editDate").value;
            const editPatientName = document.getElementById("editPatientName").value;
            const editschoolname = document.getElementById("editschoolname").value;
            const schoolyear = document.getElementById("schoolyear").value;
            const editDateefollowcheck = document.getElementById("editDateefollowcheck").value;

            // Update the first form placeholders
            document.getElementById("date-placeholder").textContent = editDate;
            document.getElementById("name-placeholder").textContent = editPatientName;
            document.getElementById("school").textContent = editschoolname;
            document.getElementById("department").textContent = schoolyear;
            document.getElementById("date").textContent = editDateefollowcheck;


            if (isValid) {
                Swal.fire({
                    title: "Success!",
                    text: 'Document has been saved successfully.',
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: 'Failed to save the document.',
                    icon: "error"
                });
            }
        }

    </script>
@endpush
