document.addEventListener("DOMContentLoaded", function () {
    /**
     *  PASSWORD MASKING
     */
    const passwordField = document.getElementById("password");
    const passwordHidden = document.getElementById("password-hidden");
    const passwordShow = document.getElementById("password-show");

    passwordHidden.addEventListener("click", () => {
        passwordField.type =
            passwordField.type === "password" ? "text" : "password";
        passwordHidden.classList.add("hidden");
        passwordShow.classList.remove("hidden");
    });

    passwordShow.addEventListener("click", () => {
        passwordField.type =
            passwordField.type === "text" ? "password" : "text";
        passwordShow.classList.add("hidden");
        passwordHidden.classList.remove("hidden");
    });

    /**
     * FORM VALIDATION
     */
    const form = document.getElementById("form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");


    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const isValid = validateInputs();

        if (isValid) {
            form.submit();
        }
    });


    // Validate inputs if form is submitted
    function validateInputs() {
        let valid = true;

        if (!validateEmail()) {
            valid = false;
        }

        if (!validatePassword()) {
            valid = false;
        }

        return valid;
    }

    // Add event listeners to trigger validation on input change
    email.addEventListener("input", () => validateEmail());
    password.addEventListener("input", () => validatePassword());

    function validateEmail() {
        const emailValue = email.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/;

        console.log("Validating email:", emailValue); // Debugging log

        if (emailValue === "") {
            setError(email, "Email field is required");
            return false;
        } else if (!emailRegex.test(emailValue)) {
            setError(email, "Provide a valid email address");
            return false;
        } else {
            setSuccess(email);
            return true;
        }
    }

    function validatePassword() {
        const passwordValue = password.value.trim();
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

        console.log("Validating password:", passwordValue); // Debugging log

        const errorDisplay = document.getElementById("password-error"); // Get the error message div

        if (passwordValue === "") {
            errorDisplay.innerText = "Password field is required"; // Populate error message
            password.classList.add("border-red-500");
            password.classList.remove("border-green-500");
            return false;
        } else if (!passwordRegex.test(passwordValue)) {
            errorDisplay.innerText =
                "Password must be at least 8 characters, with uppercase, lowercase, and a number"; // Populate error message
            password.classList.add("border-red-500");
            password.classList.remove("border-green-500");
            return false;
        } else {
            errorDisplay.innerText = ""; // Clear error message
            password.classList.add("border-green-500");
            password.classList.remove("border-red-500");
            return true;
        }
    }

    function setError(element, message) {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error"); // Ensure the .error div is correctly selected

        console.log("Setting error message:", message); // Debugging log

        if (errorDisplay) {
            errorDisplay.innerText = message; // Display the error message
        }
        element.classList.add("border-red-500");
        element.classList.remove("border-green-500");
    }

    function setSuccess(element) {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");

        if (errorDisplay) {
            errorDisplay.innerText = ""; // Clear any previous error message
        }
        element.classList.add("border-green-500");
        element.classList.remove("border-red-500");
    }
});
