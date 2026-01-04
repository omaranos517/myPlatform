const passwordToggle = document.getElementById("passwordToggle");
const passwordInput = document.getElementById("password");

if (passwordToggle && passwordInput) {
    passwordToggle.addEventListener("click", function () {
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);

        // تغيير الأيقونة
        const icon = this.querySelector("i");
        if (icon) {
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }
    });
}
