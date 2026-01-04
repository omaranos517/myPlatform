const supportModal = document.getElementById("supportModal");
const supportBtn = document.getElementById("supportBtn");
const closeSupportBtn = document.getElementById("closeSupportModel");

// فتح نافذة الدعم الفني عند النقر على الزر
supportBtn.addEventListener("click", openSupportModal);

// إغلاق نافذة الدعم الفني عند النقر على زر الإغلاق
closeSupportBtn.addEventListener("click", closeSupportModal);

// مساعدة صغيرة لإظهار إشعار (يمكن استبدالها لاحقًا بمكتبة أفضل)
function showNotification(message, type) {
    // بسيط: alert مؤقت
    alert(message);
}

window.addEventListener("scroll", initFooterAnimations());

// فتح نافذة الدعم الفني
function openSupportModal() {
    document.getElementById("supportModal").style.display = "block";
}

// إغلاق نافذة الدعم الفني
function closeSupportModal() {
    document.getElementById("supportModal").style.display = "none";
}

// إغلاق modal عند النقر خارج المحتوى
window.addEventListener("click", function (event) {
    if (event.target === supportModal) {
        closeSupportModal();
    }
});
// تشغيل الدوال عند اكتمال تحميل هيكل الصفحة
document.addEventListener("DOMContentLoaded", function () {
    initSupportForm();
    initFooterAnimations();
});

// تهيئة نموذج الإبلاغ عن المشكلات
function initSupportForm() {
    const supportForm = document.getElementById("supportForm");

    if (supportForm) {
        supportForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // هنا يمكنك إضافة كود إرسال النموذج عبر AJAX
            const formData = new FormData(this);

            // محاكاة إرسال النموذج
            const submitBtn = this.querySelector(".submit-btn");
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال';
            submitBtn.disabled = true;

            setTimeout(function () {
                submitBtn.innerHTML = '<i class="fas fa-check"></i> تم الإرسال';
                submitBtn.style.background = "var(--success)";

                setTimeout(function () {
                    closeSupportModal();
                    supportForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    submitBtn.style.background = "";

                    // إظهار رسالة نجاح
                    showNotification(
                        "تم إرسال بلاغك بنجاح، سنقوم بالرد في أقرب وقت ممكن.",
                        "success",
                    );
                }, 1500);
            }, 2000);
        });
    }
}

// إغلاق modal عند الضغط على زر Escape
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeSupportModal();
    }
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
