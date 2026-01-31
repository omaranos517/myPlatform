const toggleBtn = document.getElementById("switch");
const body = document.body;
const logoImg = document.getElementById("logo-img");

import logoDark from "../../images/logo-dark.webp";
import logoLight from "../../images/logo-light.webp";

// *! handle scroll for header progress bar
window.addEventListener("scroll", handleScrollForHeader);

function applyTheme(theme) {
    if (theme === "dark") {
        body.classList.add("dark-mode");
        if(toggleBtn) toggleBtn.checked = true;
        if(logoImg) logoImg.src = logoLight;
    } else {
        body.classList.remove("dark-mode");
        if(toggleBtn) toggleBtn.checked = false;
        if(logoImg) logoImg.src = logoDark;
    }
}

// *! apply saved theme on load
document.addEventListener("DOMContentLoaded", function () {
    // 1. استلام القيمة من السيرفر (تأكد أنها Boolean أو null)
    // نستخدم window.APP_DARK_MODE التي يفترض أنك مررتها في Blade
    const serverDarkMode = window.APP_DARK_MODE; 
    const savedTheme = localStorage.getItem("theme");

    let finalTheme;

    // 2. منطق الأولوية الصحيح
    // نتحقق مما إذا كانت القيمة ليست null وليست undefined (أي المستخدم مسجل)
    if (serverDarkMode !== null && serverDarkMode !== undefined) {
        finalTheme = serverDarkMode ? "dark" : "light";
        
        // مزامنة المتصفح فوراً مع السيرفر لضمان التوافق في المرة القادمة
        localStorage.setItem("theme", finalTheme); 
    } 
    else {
        // مستخدم زائر: نعتمد المتصفح أو ثيم الجهاز الافتراضي
        finalTheme = savedTheme || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    }

    applyTheme(finalTheme);
    handleScrollForHeader();
});

// التعامل مع التغيير اليدوي
toggleBtn.addEventListener("change", () => {
    const newTheme = toggleBtn.checked ? "dark" : "light";
    applyTheme(newTheme);
    localStorage.setItem("theme", newTheme);

    // إبلاغ السيرفر
    fetch("/theme/toggle", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ theme: newTheme }) // يفضل إرسال القيمة المختارة
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
