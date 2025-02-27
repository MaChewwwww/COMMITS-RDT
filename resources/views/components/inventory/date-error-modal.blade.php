<div id="date-error-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full h-full overflow-x-hidden overflow-y-auto flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px);">
    <div class="relative w-full max-w-sm max-h-full transform transition-all scale-95 opacity-0 duration-300" id="date-error-modal-container">
        <div class="relative bg-white rounded-lg shadow-lg border-l-4 border-red-700 overflow-hidden">
            <!-- Modal header -->
            <div class="bg-red-100 p-3 flex items-center justify-between border-b border-red-200">
                <h3 class="text-lg font-semibold text-red-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Invalid Date
                </h3>
                <button type="button" class="text-red-600 bg-transparent hover:bg-red-200 hover:text-red-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" onclick="closeErrorModal()">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 text-center">
                <svg class="mx-auto mb-3 text-red-700 w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="mb-4 text-base font-medium text-gray-800">
                    <span id="date-error-message">The expiration date must be after the received date.</span>
                </p>
                <button type="button" onclick="closeErrorModal()" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg px-4 py-2 text-sm font-medium">
                    OK, I'll fix it
                </button>
            </div>
            <!-- Modal footer with countdown -->
            <div class="px-4 py-2 bg-gray-50 text-right text-xs text-gray-500 border-t border-gray-100 flex justify-between items-center">
                <span class="text-red-700 font-medium" id="error-fix-message">Expiration date has been cleared</span>
                <span>Closing in <span id="error-modal-countdown" class="font-bold">3</span>s</span>
            </div>
        </div>
    </div>
</div>

<script>
    // We'll implement the JS functions later
</script>
