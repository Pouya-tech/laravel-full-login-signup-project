function setupPasswordToggle(btnId, inputId) {
    const toggleBtn = document.getElementById(btnId);
    const passwordInput = document.getElementById(inputId);

    // آیکون چشم باز
    const eyeOpenSvg = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        `;

    // آیکون چشم با خط مورب روش (Eye Off / Slash)
    const eyeClosedSvg = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
            </svg>
        `;

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener("click", function () {
            const isPassword =
                passwordInput.getAttribute("type") === "password";

            // تغییر نوع ورودی
            passwordInput.setAttribute(
                "type",
                isPassword ? "text" : "password",
            );

            // تغییر آیکون به چشم خط‌دار در صورت نمایش رمز
            this.innerHTML = isPassword ? eyeClosedSvg : eyeOpenSvg;

            // حالت روشنایی و شفافیت
            this.classList.toggle("text-white", isPassword);
            this.classList.toggle("text-white/70", !isPassword);
        });
    }
}

// فعال‌سازی برای هر دو فیلد
setupPasswordToggle("toggle-password", "password");
setupPasswordToggle("toggle-password-confirm", "password_confirmation");
