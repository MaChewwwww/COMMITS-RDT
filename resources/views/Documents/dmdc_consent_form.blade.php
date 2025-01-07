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
        .underlined {
            text-decoration: underline;
            text-decoration-color: #000;
            text-decoration-style: solid;
        }


        @media print {
    .header-print img {
        margin-left: -20px; /* Adjust this value to decrease the left margin */
    }

    .header-print {
        padding-left: 0;
        /* Remove or reduce left padding if needed */
    }

    .header-print p {
        font-size: 12px;
        line-height: 1.3;
        /* Adjust line spacing for paragraphs */
    }

    .header-print h2 {
        font-size: 14px;
        line-height: 1.2;
    }

    @page {
        margin: 0;
    }

    .page {
        margin-top: 0;
        position: relative;
        top: -70px;
        padding-right: 10px;
    }

    body {
        font-family: Arial;
        font-size: 12px;
    }

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
    }
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

    <div class="container mx-auto bg-white md:py-20 md:px-10 w-[90%] md:w-[70%] lg:w-[70%]">
        <div class="page">
            <!-- Document 2 (duplicate the structure as needed) -->
            <div class="container">
                <div class="flex items-center">
                    <div class="mr-5">
                        <img src="{{ asset('Logo_image/logopup.png') }}" alt="Logo" class="w-24 ">
                    </div>
                    <div style="font-family: 'Times New Roman', serif;" class="header-print">
                        <!-- Republic heading -->
                        <p class="text-sm font-normal">Republic of the Philippines</p>
                        <!-- University heading -->
                        <h2 class="text-base font-bold">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</h2>
                        <p class="text-base font-normal">OFFICE OF THE VICE PRESIDENT FOR CAMPUSES</p>
                        <!-- Location -->
                        <h2 class="text-base font-bold">QUEZON CITY CAMPUS</h2>
                    </div>

                    <!-- Medical clearance title -->

                </div>
            </div>

            <div class="md:px-10" style="font-size: 14px">
                <p class="border-b border-black w-full mb-8 ">&nbsp;</p>
                <h2 class="text-center text-lg font-bold mb-10">Declaration of Medical Information and Data Subject
                    Consent Form</h2>

                <p class="mb-8 text-justify">
                    I hereby certify that the medical health information given to the physician and nurse of this
                    campus, during my on-site consultation for the issuance of medical clearance for off-campus
                    activity/ies are true, correct and complete to the best of my knowledge. I have fully disclosed
                    all the medical conditions that may affect the assessment to endorse my participation in the
                    <span id="activityname">________________________________</span> as a student of PUP.
                </p>
                <p class="mb-8 text-justify">
                    I also understand that the PUP Medical Services and University will not be liable for any
                    untoward incident that may arise due to my failure to disclose accurate information or
                    intentionally providing false and deceptive information.
                </p>
                <p class="mb-10 text-justify">
                    In compliance with the Data Privacy Act of 2012 and its implementing Rules and Regulations, I
                    voluntarily consent to the collection, processing, and storage of my personal and health
                    information for the purpose/s of health assessment, treatment, or research (following research
                    ethics guidelines) for the improvement of healthcare services.
                </p>

                <div class="flex flex-col gap-6 pt-10">
                    <div class="flex justify-end">
                        <div class="w-1/2 text-left">
                            <p class="border-b border-black w-full">&nbsp;</p>
                            <p class="text-center mt-2">Student's Signature Over Printed Name/Age/Date</p>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <div class="w-1/2 text-left">
                            <p class="text-left mt-2">Remarks:</p> <!-- Center aligned remarks -->
                        </div>
                    </div>

                    <div class="flex justify-end pl-10">
                        <div class="w-1/2 text-left ">
                            <p class="border-b border-black w-full">&nbsp;</p>
                            <p class="text-center mt-2">Guardian's Signature Over Printed Name/Date</p>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <div class="w-1/2 text-left">
                            <p class="font-bold italic">* Both student and guardian will affix their signature if
                                the student is aged below 18 years old.</p>
                        </div>
                    </div>

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
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Edit Declaration of Medical Information</h3>

                <!-- Form Container -->
                <div id="formContainer" class="space-y-4">
                    <!-- Patient Name Field -->
                    <div class="form-group">
                        <label class="block text-gray-600 font-medium mb-1"> Name of the event or activity:</label>
                        <input type="text" id="activityNameInput" class="w-full border rounded-md px-3 py-2"
                            placeholder="Enter activity name" required>
                        <span id="nameError" class="text-red-500 text-sm hidden">Activity name is required.</span>
                    </div>
                </div>

                <div class="flex justify-center space-x-4 mt-6">
                    <button onclick="saveEdits()"
                        class="bg-[#3CAA38] hover:bg-[#2B8E2F] text-white font-medium py-2 px-20 rounded-md">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Success Notification -->
    <div id="successMessage" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96 text-center">
            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <!-- Green Checkmark Icon -->
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-lg font-semibold">Successfully Saved!</p>
        </div>
    </div>



    <script>
        // Function to print the document
        function printWaiver() {
            window.print();
        }

        // Function to go back to the previous page
        function goBack() {
            window.history.back();
        }

        // Function to open the edit modal
        function openEditForm() {
            document.getElementById("editFormModal").classList.remove("hidden");
        }

        // Function to close the edit modal
        function closeEditForm() {
            document.getElementById("editFormModal").classList.add("hidden");
        }

        // Track the form count
        let formCount = 1;

        function saveEdits() {
            // Collect the input from the form
            const activityNameInput = document.getElementById("activityNameInput").value;

            // Validate the input (checking if it's not empty)
            let isValid = true;
            if (!activityNameInput) {
                document.getElementById("nameError").classList.remove("hidden");
                isValid = false;
            } else {
                document.getElementById("nameError").classList.add("hidden");
            }

            // If validation passes, update the placeholders
            if (isValid) {
                // Update the text content for the placeholder (the dotted underline span)
                const activityNameElement = document.getElementById("activityname");

                // Update the placeholder text and add underline
                activityNameElement.textContent = activityNameInput;
                activityNameElement.classList.add("underlined");
                activityNameElement.style.textUnderlineOffset = "4px";

                // Close the modal
                closeEditForm();

                // Show success message
                const successMessage = document.getElementById("successMessage");
                successMessage.classList.remove("hidden");

                // Hide the success message after 2 seconds
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
