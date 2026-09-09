const togglePassword = document.querySelector("#toggle-password");
const passwordInput = document.querySelector('input[name="password"]'); // مطمئن شو name اینپوتت پسورد هست
const eyeIcon = document.querySelector("#eye-icon");

const eyeSlashIcon = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88L1.25 1.25m18.5 18.5l-8.5-8.5" />
    `;

const eyeIconPath = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
    `;

togglePassword.addEventListener("click", function () {
    const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);

    eyeIcon.innerHTML = type === "password" ? eyeSlashIcon : eyeIconPath;
});
