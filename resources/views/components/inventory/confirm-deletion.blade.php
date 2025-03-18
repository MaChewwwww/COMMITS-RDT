@props(['target', 'action'])

<div id="{{ $target }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                    
                    <!-- Password Input with Toggle -->
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password-{{ $target }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                            placeholder="Enter your password to confirm"
                            required
                        />
                        <button 
                            type="button"
                            onclick="togglePassword('{{ $target }}')"
                            class="absolute inset-y-0 flex items-center px-2 text-gray-600 right-5"
                        >
                            <!-- Hidden by default -->
                            <svg 
                                id="eye-open-{{ $target }}"
                                class="hidden w-5 h-5" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Shown by default -->
                            <svg 
                                id="eye-closed-{{ $target }}"
                                class="w-5 h-5" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>

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
                    function togglePassword(target) {
                        const passwordInput = document.getElementById('password-' + target);
                        const eyeOpen = document.getElementById('eye-open-' + target);
                        const eyeClosed = document.getElementById('eye-closed-' + target);
                        
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            eyeOpen.classList.remove('hidden');
                            eyeClosed.classList.add('hidden');
                        } else {
                            passwordInput.type = 'password';
                            eyeOpen.classList.add('hidden');
                            eyeClosed.classList.remove('hidden');
                        }
                    }
                </script>

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


