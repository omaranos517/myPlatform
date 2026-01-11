const supportBtn = document.getElementById("supportBtn");
const closeSupportBtn = document.getElementById("closeSupportModel");

document.getElementById("year").textContent = new Date().getFullYear();

// مساعدة صغيرة لإظهار إشعار (يمكن استبدالها لاحقًا بمكتبة أفضل)
function showNotification(message, type) {
    // بسيط: alert مؤقت
    alert(message);
}

window.addEventListener("scroll", initFooterAnimations());

// تشغيل الدوال عند اكتمال تحميل هيكل الصفحة
document.addEventListener("DOMContentLoaded", function () {
    initFooterAnimations();
});

// تأثيرات خاصة للفوتر
function initFooterAnimations() {
    const footer = document.querySelector("footer");
    const footerObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // إضافة تأثيرات للعناصر داخل الفوتر عند ظهورها
                    const socialIcons =
                        document.querySelectorAll(".social-icon");
                    socialIcons.forEach((icon, index) => {
                        // use data-delay if provided, otherwise fall back to index
                        const delay = icon.dataset.delay
                            ? parseFloat(icon.dataset.delay)
                            : index * 0.1;
                        icon.style.animationDelay = delay + "s";
                        setTimeout(() => {
                            icon.classList.add("visible");
                        }, index * 120);
                    });
                } else {
                    // عند الخروج من العرض، نزيل الكلاس حتى يعاد تشغيل التأثير عند الظهور لاحقًا
                    const socialIcons =
                        document.querySelectorAll(".social-icon");
                    socialIcons.forEach((icon) =>
                        icon.classList.remove("visible"),
                    );
                }
            });
        },
        { threshold: 0.2 },
    );

    footerObserver.observe(footer);
}
