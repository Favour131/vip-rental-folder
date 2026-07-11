const password = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");
const signupForm = document.getElementById("signupForm");

togglePassword.addEventListener("click", () => {
    if (password.type === "password") {
        password.type = "text";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
    }
});

signupForm.addEventListener("submit", (e) => {
    const passwordValue = document.getElementById("password").value;
    const confirmPasswordValue = document.getElementById("confirmPassword").value;
    const phoneValue = document.querySelector('input[name="phone_number"]').value.trim();
    const digitsOnly = phoneValue.replace(/\D/g, "");
    const phoneRegex = /^\+?[0-9\s\-()]{10,20}$/;

    if (passwordValue !== confirmPasswordValue) {
        e.preventDefault();
        alert("Passwords do not match.");
        return;
    }

    if (!phoneRegex.test(phoneValue) || digitsOnly.length < 10) {
        e.preventDefault();
        alert("Please verify ur phone number");
    }
});