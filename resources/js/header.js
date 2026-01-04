const toggleBtn = document.getElementById("switch");
const body = document.body;
const logoImg = document.getElementById("logo-img");

// تهيئة تأثير التمرير
window.addEventListener("scroll", handleScrollForHeader);

// جعل الوضع النهاري هو الافتراضي
document.addEventListener("DOMContentLoaded", function () {
    // اقرأ الوضع المخزن من localStorage
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        body.classList.add("dark-mode");
        toggleBtn.checked = true;
        logoImg.src = "../images/logo-light.png";
    } else {
        body.classList.remove("dark-mode");
        toggleBtn.checked = false;
        logoImg.src = "../images/logo-dark.png";
    }

    // تهيئة تأثير التمرير
    handleScrollForHeader();
});

// التعامل مع تبديل الوضع
toggleBtn.addEventListener("change", () => {
    if (toggleBtn.checked) {
        body.classList.add("dark-mode");
        logoImg.src = "../images/logo-light.png";
        localStorage.setItem("theme", "dark");
    } else {
        body.classList.remove("dark-mode");
        logoImg.src = "../images/logo-dark.png";
        localStorage.setItem("theme", "light");
    }
});

function handleScrollForHeader() {
    const scrollTop =
        document.documentElement.scrollTop || document.body.scrollTop;
    const scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    const scrollPercent = (scrollTop / scrollHeight) * 100;
    document.getElementById("progressBar").style.width = scrollPercent + "%";
}
