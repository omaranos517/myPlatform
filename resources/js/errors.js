// إضافة تأثيرات عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", function () {
    // إضافة تأثيرات للعناصر
    const errorSection = document.querySelector(".error-section");
    if (errorSection) {
        setTimeout(() => {
            errorSection.classList.add(
                "animate__animated",
                "animate__fadeInUp",
            );
        }, 100);
    }

    // إضافة تأثيرات للأزرار
    const buttons = document.querySelectorAll(".action-btn");
    buttons.forEach((button) => {
        button.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-5px) scale(1.05)";
        });

        button.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0) scale(1)";
        });
    });

    // منع إعادة إرسال النموذج عند تحديث الصفحة
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // التحقق من حالة الوضع الداكن
    if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("dark-mode");
    }
});

// تأثيرات إضافية للأيقونة
const errorIcon = document.querySelector(".error-icon");
if (errorIcon) {
    setInterval(() => {
        errorIcon.style.animation = "none";
        setTimeout(() => {
            errorIcon.style.animation = "float 3s ease-in-out infinite";
        }, 10);
    }, 10000); // كل 10 ثواني
}
