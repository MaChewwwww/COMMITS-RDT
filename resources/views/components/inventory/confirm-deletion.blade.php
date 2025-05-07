@props(['target', 'action'])

<div id="{{ $target }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full max-h-full overflow-x-hidden overflow-y-auto md:inset-0">
    <div class="relative w-full max-w-md max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow-sm">
            <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="{{ $target }}"
            >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>

                <h3 class="mb-6 text-lg font-normal text-gray-500">Are you sure you want to delete this record?</h3>

                <!-- Error Message Container -->
                <div id="error-message-{{ $target }}" class="hidden p-4 mb-4 text-sm text-red-600 bg-red-100 rounded-lg"></div>

                <form id="delete-form-{{ $target }}" method="POST" action="{{ $action }}" class="space-y-6">
                    @csrf
                    @method('DELETE')
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-center gap-3">
                        <button
                            type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        >
                            Yes, I'm sure
                        </button>
                        <button
                            type="button"
                            data-modal-hide="{{ $target }}"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        >
                            No, cancel
                        </button>
                    </div>
                </form>

                <script>
                    document.getElementById('delete-form-{{ $target }}').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const form = this;
                        const errorDiv = document.getElementById('error-message-{{ $target }}');

                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: new FormData(form)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                // Show error message
                                errorDiv.textContent = data.error;
                                errorDiv.classList.remove('hidden');
                            } else if (data.success) {
                                // Success - reload the page
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            errorDiv.textContent = 'An error occurred. Please try again.';
                            errorDiv.classList.remove('hidden');
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>


