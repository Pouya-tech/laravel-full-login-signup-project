document.addEventListener("click", (e) => {
    const btn = e.target.closest("#toggle-password");
    if (!btn) return;

    e.preventDefault();
    const input = document.getElementById("password");

    if (input) {
        input.type = input.type === "password" ? "text" : "password";
    }
});
