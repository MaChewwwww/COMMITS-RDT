<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Waiver Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Adjusting for print */
        @media print {
            header {
                padding: 0;
            }

            @page {
                size: A4;
                margin: 0;

            }

            .page {
                margin-top: 0;
                /* Move the form up */
                position: relative;
                top: -40px;
                /* Adjust to move the form higher */
                margin-top: 0;
            }

            body {
                font-family: Arial;
                font-size: 12px;
            }

            /* Hide all content except the container */
            body * {
                visibility: hidden;
            }

            .container,
            .container * {
                visibility: visible;
            }

            .page {
                display: block;
                height: 100%;

            }

            .flex-container {
                flex-direction: column;
                /* gap: 5px; */
            }
        }

        /* Make the modal scrollable */
        .modal-content1 {
            max-height: 80vh;
            /* Limit the height to 80% of the viewport */
            overflow-y: auto;
            /* Enable vertical scrolling if content exceeds */
            padding-right: 15px;
            /* Add space for scrollbar */
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Buttons (Optional for print view, you can hide them when printing) -->
    <div class="flex space-x-10 justify-between mb-5 p-4">
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
            <!-- Document 2 (duplicate the structure as needed) -->
            <div class="container">
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
                        <h2 class="text-xl font-semibold">MEDICAL CLEARANCE</h2>
                    </div>

                </div>

                <div class="text-right my-10 mb-8 font-Arial">
                    <span> <span id="date-placeholder" class="underline-offset-4">Date ___________________</span>
                </div>

                <div class="space-y-4 font-Arial mb-5">
                    <p>To Whom It May Concern:</p>
                    <p class="indent-8">
                        This is to clarify that <span id="name-placeholder" class="underline-offset-4">
                            __________________________________________________________________________</span>
                        has been examined by the undersigned and found to be physically fit at the time of examination.
                    </p>
                    <p class="indent-8">
                        This certification is issued upon his/her request for <span id="excuse-placeholder"
                            class="underline-offset-4"> ______________________________________________________________________________________________</span> purposes but not for medico-legal
                        reason.
                    </p>

                </div>
                <!-- Flex Row for COVID Status and Signature -->
                <div class="flex justify-between pt-10">
                    <div id="" class="w-1/2 text-left">
                        <p>COVID-19 Vaccination Status:</p>
                        <p><span class="checkbox" id="status-unvaccinated">_____</span> Unvaccinated</p>
                        <p><span class="checkbox" id="status-incomplete">_____</span> Primary series incomplete</p>
                        <p><span class="checkbox" id="status-completed">_____</span> Primary dose / series completed</p>
                        <p><span class="checkbox" id="status-boosters">_____</span> 1st / second Boosters</p>
                    </div>
                    <div class="w-11/30 text-left">
                        <p><br>Melissa Sarapuddin M.D.</p>
                        <p>Quezon City Campus Physician</p>
                        <p>Lic No. <span id="lic_no-placeholder"
                                class="underline-underoffset-4">____________________</span></p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Document 2 (duplicate the structure as needed) -->
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
                    <h2 class="text-xl font-semibold">MEDICAL CLEARANCE</h2>
                </div>

            </div>

            <div class="text-right my-10 mb-0 font-Arial">
                <span><span id="date-placeholder2" class="underline-offset-4">Date ____________________</span>
            </div>

            <div class="space-y-4 font-Arial mb-5">
                <p>To Whom It May Concern:</p>
                <p class="indent-8">
                    This is to clarify that <span id="name-placeholder2" class="underline-offset-4">
                        __________________________________________________________________________</span>
                    has been examined by the undersigned and found to be physically fit at the time of examination.
                </p>
                <p class="indent-8">
                    This certification is issued upon his/her request for <span id="excuse-placeholder2"
                        class="underline-offset-4"> ______________________________________________________________________________________________</span> purposes but not for medico-legal
                    reason.
                </p>

            </div>
            <div class="mt-5">
                <span>X-ray Result: <span id="x-ray-placeholder2" class="underline-offset-4">
                        ____________________</span>
            </div>
            <!-- Flex Row for COVID Status and Signature -->
            <div class="flex justify-between mt-10">
                <div class="w-1/2 text-left">
                    <p>COVID-19 Vaccination Status:</p>
                    <p><span class="checkbox" id="status-unvaccinated2">_____</span> Unvaccinated</p>
                    <p><span class="checkbox" id="status-incomplete2">_____</span> Primary series incomplete</p>
                    <p><span class="checkbox" id="status-completed2">_____</span> Primary dose / series completed
                    </p>
                    <p><span class="checkbox" id="status-boosters2">_____</span> 1st / second Boosters</p>
                </div>
                <div class="w-11/30 text-left">
                    <p>Melissa Sarapuddin M.D.</p>
                    <p>Quezon City Campus Physician</p>
                    <p>Lic No. <span id="lic_no-placeholder2" class="underline-underoffset-4"> ____________________</span></p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="editFormModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="modal-content1 bg-white rounded-lg shadow-lg p-6 w-full max-w-lg relative">
                <!-- Close Button in Top-Right -->
                <span class="close absolute top-2.5 right-2.5 text-red-500 text-2xl cursor-pointer hover:text-red-700"
                    onclick="closeEditForm()">&times;</span>

                <!-- Modal Title -->
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Edit Medical Clearance Form</h3>

                <!-- Form Container -->
                <div id="formContainer" class="space-y-4">
                    <!-- Date Field -->
                    <div class="form-group">
                        <label class="block text-gray-600 font-medium mb-1">Date:</label>
                        <input type="date" id="editDate"
                            class="editDate w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <span id="dateError" class="text-red-500 text-sm hidden">Date is required.</span>
                    </div>

                    <!-- Patient Name Field -->
                    <div class="form-group">
                        <label class="block text-gray-600 font-medium mb-1">Patient's Name:</label>
                        <input type="text" id="editPatientName"
                            class="editPatientName w-full border rounded-md px-3 py-2"
                            placeholder="Enter patient's name" required>
                        <span id="nameError" class="text-red-500 text-sm hidden">Name is required.</span>
                    </div>

                    <!-- Excuse Field -->
                    <div class="form-group">
                        <label class="block text-gray-600 font-medium mb-1">Excuse for:</label>
                        <input type="text" id="editExcuse" class="editExcuse w-full border rounded-md px-3 py-2"
                            placeholder="Reason for excuse">
                    </div>

                    <!-- Vaccination Status -->
                    <div class="form-group">
                        <label class="block text-gray-600 font-medium mb-2">COVID-19 Vaccination Status:</label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="vaccination" value="Unvaccinated" class="text-blue-500">
                                <span class="ml-2 text-gray-700">Unvaccinated</span>
                            </label><br>
                            <label class="inline-flex items-center">
                                <input type="radio" name="vaccination" value="Primary series incomplete"
                                    class="text-blue-500">
                                <span class="ml-2 text-gray-700">Primary series incomplete</span>
                            </label><br>
                            <label class="inline-flex items-center">
                                <input type="radio" name="vaccination" value="Primary dose completed"
                                    class="text-blue-500">
                                <span class="ml-2 text-gray-700">Primary dose / series completed</span>
                            </label><br>
                            <label class="inline-flex items-center">
                                <input type="radio" name="vaccination" value="Boosters" class="text-blue-500">
                                <span class="ml-2 text-gray-700">1st / second Boosters</span>
                            </label>
                        </div>
                    </div>

                    <!-- License Number -->
                    <div class="form-group">
                        <label class="block text-gray-600 font-medium mb-1">Lic No:</label>
                        <input type="text" id="lic_no" class="Licno w-full border rounded-md px-3 py-2"
                            placeholder="License number" required>
                        <span id="licError" class="text-red-500 text-sm hidden">License number is required.</span>
                    </div>
                </div>


                <div class="flex justify-end space-x-4 mt-6">
                    <button onclick="addForm()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md">
                        Add Form
                    </button>
                    <button onclick="saveEdits()"
                        class="bg-[#3CAA38] hover:bg-[#2B8E2F] text-white font-medium py-2 px-4 rounded-md">
                        Save
                    </button>
                </div>
            </div>
        </div>
        <!-- Success Notification -->
        <div id="successMessage" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96 text-center">
                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <!-- Green Checkmark Icon -->
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-lg font-semibold">Successfully Saved!</p>
            </div>
        </div>



        <script>
            function printWaiver() {
                window.print();
            }

            function goBack() {
                window.history.back();
            }

            function openEditForm() {
                document.getElementById("editFormModal").classList.remove("hidden");
            }

            function closeEditForm() {
                document.getElementById("editFormModal").classList.add("hidden");
            }

            let formCount = 1; // To keep track of form count

            function addForm() {
                if (formCount < 2) {
                    console.log("Add Form button clicked");
                    // Select the container where new forms will be added
                    const formContainer = document.getElementById('formContainer');

                    // Create a new form group
                    const newFormGroup = document.createElement('div');
                    newFormGroup.classList.add('form-group', 'mt-8'); // Add spacing for clarity

                    // Set the HTML structure of the new form
                    newFormGroup.innerHTML = `
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Form ${formCount + 1}</h2>
    <div class="space-y-4"> <!-- Added space-y-4 here -->
        <label class="block text-gray-600 font-medium mb-1">Date:</label>
        <input type="date" id="editDate${formCount}"
            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label class="block text-gray-600 font-medium mb-1">Patient's Name:</label>
        <input type="text" id="editPatientName${formCount}"
            class="w-full border rounded-md px-3 py-2" placeholder="Enter patient's name">

        <label class="block text-gray-600 font-medium mb-1">Excuse for:</label>
        <input type="text" id="editExcuse${formCount}"
            class="w-full border rounded-md px-3 py-2" placeholder="Reason for excuse">

        <label class="block text-gray-600 font-medium mb-1">X-ray result:</label>
        <input type="text" id="editXray${formCount}"
            class="w-full border rounded-md px-3 py-2" placeholder="X-ray result">

        <label class="block text-gray-600 font-medium mb-2">COVID-19 Vaccination Status:</label>
        <div class="space-y-2">
            <label class="inline-flex items-center">
                <input type="radio" name="vaccination${formCount}" value="Unvaccinated" class="text-blue-500">
                <span class="ml-2 text-gray-700">Unvaccinated</span>
            </label><br>
            <label class="inline-flex items-center">
                <input type="radio" name="vaccination${formCount}" value="Primary series incomplete" class="text-blue-500">
                <span class="ml-2 text-gray-700">Primary series incomplete</span>
            </label><br>
            <label class="inline-flex items-center">
                <input type="radio" name="vaccination${formCount}" value="Primary dose completed" class="text-blue-500">
                <span class="ml-2 text-gray-700">Primary dose / series completed</span>
            </label><br>
            <label class="inline-flex items-center">
                <input type="radio" name="vaccination${formCount}" value="Boosters" class="text-blue-500">
                <span class="ml-2 text-gray-700">1st / second Boosters</span>
            </label>
        </div>

        <label class="block text-gray-600 font-medium mb-1">Lic No:</label>
        <input type="text" id="licNo${formCount}"
            class="w-full border rounded-md px-3 py-2" placeholder="License number">
    </div> <!-- End of space-y-4 -->
        `;

                    // Append the new form group to the container
                    formContainer.appendChild(newFormGroup);

                    // Increment formCount
                    formCount++;

                    // Hide the "Add Form" button after adding the second form
                    if (formCount === 2) {
                        document.querySelector("button[onclick='addForm()']").style.display = 'none';
                    }
                } else {
                    alert("You can only add 2 forms.");
                }
            }

            function saveEdits() {
                // Capture user inputs for Form 1
                const waiverDate1 = document.querySelector(".editDate").value;
                const patientName1 = document.querySelector(".editPatientName").value;
                const excuse1 = document.querySelector(".editExcuse").value;
                const licNoValue1 = document.querySelector(".Licno").value;

                // Capture user inputs for Form 2
                const waiverDate2 = document.getElementById("editDate1")?.value || ""; // Check if form exists
                const patientName2 = document.getElementById("editPatientName1")?.value || "";
                const excuse2 = document.getElementById("editExcuse1")?.value || "";
                // const xrayResult2 = document.getElementById("editXray1")?.value || "";
                const licNoValue2 = document.getElementById("licNo1")?.value || "";
                const xrayResult2 = document.getElementById("editXray1")?.value || "";



                // Function to update placeholders with underline styling
                function updateWithUnderline(elementId, value) {
                    const element = document.getElementById(elementId);
                    if (element) {
                        element.style.textDecoration = "underline";
                        element.style.textUnderlineOffset = "4px"; // Adjust the offset for styling
                        element.innerText = value || "_____"; // Fallback to empty placeholder if no value
                    }
                }




                // Handle vaccination status updates for both forms
                const selectedVaccination1 = document.querySelector('input[name="vaccination"]:checked');
                const selectedVaccination2 = document.querySelector('input[name="vaccination1"]:checked');

                if (selectedVaccination1) {
                    document.querySelectorAll('.checkbox').forEach(el => (el.textContent = '_____ ')); // Reset all checkboxes
                    switch (selectedVaccination1.value) {
                        case 'Unvaccinated':
                            document.getElementById('status-unvaccinated').textContent = '__✔__';
                            break;
                        case 'Primary series incomplete':
                            document.getElementById('status-incomplete').textContent = '__✔__';
                            break;
                        case 'Primary dose completed':
                            document.getElementById('status-completed').textContent = '__✔__';
                            break;
                        case 'Boosters':
                            document.getElementById('status-boosters').textContent = '__✔__';
                            break;
                    }
                }

                if (selectedVaccination2) {
                    switch (selectedVaccination2.value) {
                        case 'Unvaccinated':
                            const unvaccinated2 = document.getElementById('status-unvaccinated2');
                            unvaccinated2.textContent = '__✔__';  // Add underscores here
                            break;
                        case 'Primary series incomplete':
                            const incomplete2 = document.getElementById('status-incomplete2');
                            incomplete2.textContent = '__✔__';  // Add underscores here
                            break;
                        case 'Primary dose completed':
                            const completed2 = document.getElementById('status-completed2');
                            completed2.textContent = '__✔__';  // Add underscores here
                            break;
                        case 'Boosters':
                            const boosters2 = document.getElementById('status-boosters2');
                            boosters2.textContent = '__✔__';  // Add underscores here
                            break;
                    }
                }

                // Validation logic for Form 1
                let isValid = true;

                // Validate Date for Form 1
                const dateError = document.getElementById("dateError");
                if (!waiverDate1) {
                    dateError.classList.remove("hidden");
                    isValid = false;
                } else {
                    dateError.classList.add("hidden");
                }

                // Validate Name for Form 1
                const nameError = document.getElementById("nameError");
                if (!patientName1.trim()) {
                    nameError.classList.remove("hidden");
                    isValid = false;
                } else {
                    nameError.classList.add("hidden");
                }

                                // Validate License for Form 1
                                const licError = document.getElementById("licError");
                if (!licNoValue1.trim()) {
                    licError.classList.remove("hidden");
                    isValid = false;
                } else {
                    licError.classList.add("hidden");
                }



                // Validation logic for Form 2 (if it exists)
                if (waiverDate2 || patientName2 || excuse2 || licNoValue2 || xrayResult2) {
                    if (!waiverDate2) {
                        isValid = false;
                        alert("Please fill in the Date for Form 2.");
                    }
                    if (!patientName2.trim()) {
                        isValid = false;
                        alert("Please fill in the Patient Name for Form 2.");
                    }
                    if (!licNoValue2.trim()) {
                        isValid = false;
                        alert("Please fill in the License Number for Form 2.");
                    }
                }

                // If validation passes
                if (isValid) {
                    // Update placeholders for Form 1
                    updateWithUnderline("date-placeholder", waiverDate1);
                    updateWithUnderline("name-placeholder", patientName1);
                    updateWithUnderline("excuse-placeholder", excuse1);
                    updateWithUnderline("lic_no-placeholder", licNoValue1);

                    // Update placeholders for Form 2 (if it exists)
                    if (waiverDate2 || patientName2 || excuse2 || licNoValue2 || xrayResult2) {
                        updateWithUnderline("date-placeholder2", waiverDate2);
                        updateWithUnderline("name-placeholder2", patientName2);
                        updateWithUnderline("excuse-placeholder2", excuse2);
                        updateWithUnderline("lic_no-placeholder2", licNoValue2);
                        updateWithUnderline("x-ray-placeholder2", xrayResult2);

                    }
                    // Show success message
                    const successMessage = document.getElementById("successMessage");
                    successMessage.classList.remove("hidden");

                    // Hide success message and trigger print after a delay
                    setTimeout(() => {
                        successMessage.classList.add("hidden");
                        closeEditForm();
                        window.print();
                    }, 2000);
                }
            }

        </script>

</body>

</html>
