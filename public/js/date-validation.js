/**
 * Date validation for inventory forms
 */
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to date fields
    setupDateValidation('date_received', 'expiration_date', 'add');
    
    // For edit forms, we need to find all instances
    document.querySelectorAll('[id^="edit-"]').forEach(form => {
        const formId = form.id;
        if (formId.includes('medicine-form')) {
            const id = formId.replace('edit-medicine-form-', '');
            setupDateValidation(`edit-date-received-${id}`, `edit-expiration-date-${id}`, 'edit');
        }
    });
    
    // Initialize countdown timer for error modal
    let countdownInterval = null;
    window.startErrorModalCountdown = function() {
        // Reset countdown first
        const countdownEl = document.getElementById('error-modal-countdown');
        if (!countdownEl) return;
        
        // Clear any existing interval
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
        
        countdownEl.textContent = '3';
        let seconds = 3;
        
        countdownInterval = setInterval(() => {
            seconds--;
            countdownEl.textContent = seconds.toString();
            
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                closeErrorModal();
            }
        }, 1000);
    };
    
    // Set up validation for a pair of date inputs
    function setupDateValidation(receivedDateId, expirationDateId, prefix) {
        const receivedDateEl = document.getElementById(receivedDateId);
        const expirationDateEl = document.getElementById(expirationDateId);
        
        if (!receivedDateEl || !expirationDateEl) return;
        
        // Listen for changes in both date fields
        receivedDateEl.addEventListener('change', () => validateDates(receivedDateEl, expirationDateEl));
        expirationDateEl.addEventListener('change', () => validateDates(receivedDateEl, expirationDateEl));
        
        // Initial validation
        if (receivedDateEl.value && expirationDateEl.value) {
            validateDates(receivedDateEl, expirationDateEl);
        }
    }
    
    // Function to validate dates
    function validateDates(receivedDateEl, expirationDateEl) {
        if (!receivedDateEl.value || !expirationDateEl.value) return true;
        
        const receivedDate = new Date(receivedDateEl.value);
        const expirationDate = new Date(expirationDateEl.value);
        
        if (expirationDate <= receivedDate) {
            // Clear the expiration date field
            expirationDateEl.value = '';
            
            // Show the error modal
            showErrorModal('Expiration date must be after the received date.');
            
            // Add validation styles
            expirationDateEl.classList.add('border-red-500');
            
            // Focus on the expiration date field after modal closes
            setTimeout(() => {
                expirationDateEl.focus();
            }, 3500);
            
            return false;
        } else {
            // Remove validation styles
            expirationDateEl.classList.remove('border-red-500');
            
            return true;
        }
    }
});

// Show error modal with animation
function showErrorModal(message) {
    const modal = document.getElementById('date-error-modal');
    const container = document.getElementById('date-error-modal-container');
    const messageEl = document.getElementById('date-error-message');
    const fixMessageEl = document.getElementById('error-fix-message');
    
    if (!modal || !container || !messageEl) return;
    
    // Set the error message
    messageEl.textContent = message;
    
    // Initially hide the fix message
    if (fixMessageEl) {
        fixMessageEl.classList.add('opacity-0');
        
        // Show it after a short delay for a nice sequential animation
        setTimeout(() => {
            fixMessageEl.classList.remove('opacity-0');
        }, 500);
    }
    
    // Show the modal
    modal.classList.remove('hidden');
    
    // Animate in with a slight bounce effect
    setTimeout(() => {
        container.classList.remove('scale-95', 'opacity-0');
        container.classList.add('scale-100', 'opacity-100');
        
        // Add a subtle bounce
        setTimeout(() => {
            container.classList.add('scale-102');
            setTimeout(() => {
                container.classList.remove('scale-102');
            }, 100);
        }, 200);
    }, 10);
    
    // Start countdown
    if (window.startErrorModalCountdown) {
        window.startErrorModalCountdown();
    }
    
    return false;
}

// Close error modal with animation
function closeErrorModal() {
    const modal = document.getElementById('date-error-modal');
    const container = document.getElementById('date-error-modal-container');
    
    if (!modal || !container) return;
    
    // Animate out
    container.classList.remove('scale-100', 'opacity-100', 'scale-102');
    container.classList.add('scale-95', 'opacity-0');
    
    // Hide after animation completes
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Function to be called from form's onsubmit
function validateDateSubmit(receivedDateId, expirationDateId) {
    const receivedDateEl = document.getElementById(receivedDateId);
    const expirationDateEl = document.getElementById(expirationDateId);
    
    if (!receivedDateEl || !expirationDateEl) return true;
    
    if (!receivedDateEl.value || !expirationDateEl.value) return true;
    
    const receivedDate = new Date(receivedDateEl.value);
    const expirationDate = new Date(expirationDateEl.value);
    
    if (expirationDate <= receivedDate) {
        // Clear the expiration date field
        expirationDateEl.value = '';
        
        // Show the error modal
        showErrorModal('Expiration date must be after the received date.');
        
        return false;
    }
    
    return true;
}
