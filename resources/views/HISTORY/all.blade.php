<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Smooth transitions for item deletion */
        .history-item {
            transition: background-color 0.3s ease;
        }
        .history-item.selected {
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-white text-black p-6">

    <div class="max-w-4xl mx-auto bg-white p-4 rounded-lg shadow-lg">

        <!-- Search Bar -->
        <div class="border-b border-gray-400 pb-2 mb-4 flex items-center gap-2">
            <form class="flex-grow max-w-[300px] relative">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-400 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                    class="block w-full max-w-[300px] h-8 p-2 ps-9 text-xs text-gray-700 border border-gray-300 rounded-md bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    placeholder="Search history..." required />
                </div>
            </form>
            <button type="submit"
                class="h-8 px-3 bg-blue-700 text-white rounded-md text-xs font-medium hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Search
            </button>
            <button id="delete-selected"
                class="hidden h-8 px-3 bg-red-600 text-white rounded-md text-xs font-medium hover:bg-red-700 cursor-not-allowed"
                disabled>
                Delete
            </button>
        </div>

        <!-- History List -->
        <h2 class="text-lg font-semibold mb-2 text-gray-700">Today - Wednesday, February 12, 2025</h2>
        <ul id="history-list" class="space-y-2">
            <li class="flex items-center space-x-4 history-item">
                <input type="checkbox" class="history-checkbox">
                <span class="text-gray-400">4:09 PM</span>
                <span class="text-red-500 font-semibold">Server Error</span>
                <span class="text-gray-400">127.0.0.1:8000</span>
            </li>
            <li class="flex items-center space-x-4 history-item">
                <input type="checkbox" class="history-checkbox">
                <span class="text-gray-400">4:06 PM</span>
                <span class="text-red-500 font-semibold">Server Error</span>
                <span class="text-gray-400">127.0.0.1:8000</span>
            </li>
            <li class="flex items-center space-x-4 history-item">
                <input type="checkbox" class="history-checkbox">
                <span class="text-gray-400">3:48 PM</span>
                <span class="font-semibold text-gray-700">Missing Autoload File Fix</span>
                <span class="text-gray-400">chatgpt.com</span>
            </li>
            <li class="flex items-center space-x-4 history-item">
                <input type="checkbox" class="history-checkbox">
                <span class="text-gray-400">3:47 PM</span>
                <span class="font-semibold text-gray-700">ChatGPT</span>
                <span class="text-gray-400">chatgpt.com</span>
            </li>
            <li class="flex items-center space-x-4 history-item">
                <input type="checkbox" class="history-checkbox">
                <span class="text-gray-400">3:42 PM</span>
                <span class="font-semibold text-gray-700">Confirm access</span>
                <span class="text-gray-400">github.com</span>
            </li>
        </ul>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Are you sure?</h3>
            <p class="mb-6 text-gray-600">Do you want to delete the selected history items?</p>
            <div class="flex justify-between">
                <button id="cancel-delete" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                <button id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll(".history-checkbox");
        const deleteButton = document.getElementById("delete-selected");
        const historyList = document.getElementById("history-list");
        const historyItems = document.querySelectorAll(".history-item");
        const confirmationModal = document.getElementById("confirmation-modal");
        const confirmDeleteButton = document.getElementById("confirm-delete");
        const cancelDeleteButton = document.getElementById("cancel-delete");

        // Show/hide delete button and highlight selected items
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                deleteButton.classList.toggle("hidden", !anyChecked);
                deleteButton.disabled = !anyChecked;
                deleteButton.classList.toggle("cursor-not-allowed", !anyChecked);

                // Highlight the selected items
                historyItems.forEach(item => {
                    if (item.querySelector("input").checked) {
                        item.classList.add("selected");
                    } else {
                        item.classList.remove("selected");
                    }
                });
            });
        });

        // Show confirmation modal before deleting
        deleteButton.addEventListener("click", function () {
            confirmationModal.classList.remove("hidden");
        });

        // Handle the cancel action
        cancelDeleteButton.addEventListener("click", function () {
            confirmationModal.classList.add("hidden");
        });

        // Handle the confirm delete action
        confirmDeleteButton.addEventListener("click", function () {
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkbox.parentElement.remove(); // Remove parent <li> element
                }
            });

            // Hide the modal and reset the delete button
            confirmationModal.classList.add("hidden");
            deleteButton.classList.add("hidden");
        });

        historyItems.forEach(item => {
            item.addEventListener("click", function (event) {
                // Check if the clicked element is NOT a checkbox
                if (!event.target.classList.contains("history-checkbox")) {
                    alert("History item clicked: " + item.textContent.trim());
                }
            });
        });

    </script>

</body>
</html>
