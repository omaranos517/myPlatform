const toggleBtn = document.getElementById("switch");
const body = document.body;
const logoImg = document.getElementById("logo-img");

import logoDark from '../../images/logo-dark.webp';
import logoLight from '../../images/logo-light.webp';

// تهيئة تأثير التمرير
window.addEventListener("scroll", handleScrollForHeader);

// جعل الوضع النهاري هو الافتراضي
document.addEventListener("DOMContentLoaded", function () {

    const serverDarkMode = window.APP_DARK_MODE;

    const savedTheme = localStorage.getItem("theme");

    console.log("Saved Theme:", savedTheme);

    let finalTheme;

    // ✅ لو مسجل دخول → السيرفر هو الأساس
    if (typeof serverDarkMode === "boolean") {
        finalTheme = serverDarkMode ? "dark" : "light";
    }
    // ✅ لو زائر → localStorage
    else {
        finalTheme = savedTheme ?? "light";
    }

    if (finalTheme === "dark") {
        body.classList.add("dark-mode");
        toggleBtn.checked = true;
        logoImg.src = logoLight;
    } else {
        body.classList.remove("dark-mode");
        toggleBtn.checked = false;
        logoImg.src = logoDark;
    }

    localStorage.setItem("theme", finalTheme);

    handleScrollForHeader();
});


// التعامل مع تبديل الوضع
toggleBtn.addEventListener("change", () => {
    
    const isDark = toggleBtn.checked;

    if (isDark) {
        body.classList.add("dark-mode");
        logoImg.src = logoLight;
        localStorage.setItem("theme", "dark");
    } else {
        body.classList.remove("dark-mode");
        logoImg.src = logoDark;
        localStorage.setItem("theme", "light");
    }

    // 🔥 إرسال التغيير لقاعدة البيانات
    fetch("/theme/toggle", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .content,
        },
    });
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
