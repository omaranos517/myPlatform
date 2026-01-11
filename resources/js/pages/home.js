const hero = document.getElementById("hero");
const heroContent = document.getElementById("hero-content");

// تهيئة تأثير التمرير
window.addEventListener("scroll", handleScroll);

// جعل الوضع النهاري هو الافتراضي
document.addEventListener("DOMContentLoaded", function () {
    // تهيئة تأثير التمرير
    handleScroll();

    // تهيئة عناصر الرسوم المتحركة عند التمرير
    initScrollAnimation();

    // تهيئة باقي الأنظمة
    initAnimations();
    initScrollEffects();
});

// تهيئة الرسوم المتحركة
function initAnimations() {
    const animatedElements = document.querySelectorAll(
        ".subject-card, .stat-card, .feature, .testimonial-card",
    );
    animatedElements.forEach((el) => {
        el.classList.add("animate-on-scroll");
    });
}

// تأثيرات التمرير
function initScrollEffects() {
    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1,
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("in-view");
                entry.target.style.transition =
                    "opacity 0.6s ease, transform 0.6s ease";

                // إضافة تأثيرات خاصة للعناصر المختلفة
                if (entry.target.classList.contains("subject-card")) {
                    entry.target.style.transitionDelay =
                        Math.random() * 0.3 + "s";
                }
            }
        });
    }, observerOptions);

    // مراقبة العناصر التي نريد إضافة تأثيرات لها
    document
        .querySelectorAll(
            ".subject-card, .stat-card, .feature, .testimonial-card",
        )
        .forEach((el) => {
            observer.observe(el);
        });
}

// تأثيرات التمرير (محسنة)
function handleScroll() {
    const scrollPosition = window.scrollY;
    const winScroll =
        document.body.scrollTop || document.documentElement.scrollTop;
    const height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;

    // تأثيرات التمرير الأخرى
    const heroContent = document.getElementById("hero-content");
    let contentScale = 1;
    let contentOpacity = 1;

    if (scrollPosition > 0) {
        contentScale = Math.max(1 - scrollPosition / 1000, 0.8);
        contentOpacity = Math.max(1 - scrollPosition / 500, 0.5);
    }

    heroContent.style.transform = `scale(${contentScale})`;
    heroContent.style.opacity = contentOpacity;

    // تفعيل الرسوم المتحركة عند التمرير
    handleScrollAnimation();
}

// تطبيق تأثير Blur باستخدام CSS variable
document.documentElement.style.setProperty("--blur-amount", "0px");

// تهيئة الرسوم المتحركة عند التمرير
function initScrollAnimation() {
    const elements = document.querySelectorAll(".animate-on-scroll");
    elements.forEach((el) => {
        el.classList.remove("animated");
    });
}

// تفعيل الرسوم المتحركة عند التمرير
function handleScrollAnimation() {
    const elements = document.querySelectorAll(".animate-on-scroll");
    elements.forEach((el) => {
        const elementTop = el.getBoundingClientRect().top;
        const elementVisible = 150;

        if (elementTop < window.innerHeight - elementVisible) {
            el.classList.add("animated");
        }
    });
}

// تفعيل الرسوم المتحركة عند التحميل الأولي
window.addEventListener("load", handleScrollAnimation);

// منع إعادة إرسال النموذج عند تحديث الصفحة
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// إضافة دالة للكشف عن حجم الشاشة وتطبيق تحسينات إضافية
function handleResponsiveFeatures() {
    const width = window.innerWidth;

    // على الشاشات الصغيرة، تقليل تأثيرات بعض الرسوم المتحركة لتحسين الأداء
    if (width < 768) {
        document.documentElement.style.setProperty(
            "--transition",
            "all 0.2s ease",
        );

        // تقليل تأثير الطفو على الشاشات الصغيرة
        const floatElements = document.querySelectorAll(".animate-float");
        floatElements.forEach((el) => {
            el.style.animation = "none";
        });
    } else {
        document.documentElement.style.setProperty(
            "--transition",
            "all 0.3s ease",
        );
    }

    // على الشاشات الصغيرة جداً، إخفاء بعض العناصر غير الضرورية
    if (width < 400) {
        const decorativeElements = document.querySelectorAll(
            ".decoration, .slider:before",
        );
        decorativeElements.forEach((el) => {
            el.style.display = "none";
        });
    }
}

window.addEventListener("scroll", () => {
    const scrolled = window.scrollY;

    // تأثير التحرك للصورة في قسم البداية
    const heroImage = document.querySelector(".hero");
    if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.1}px)`;
    }
});

function smoothScrollTo(targetY, duration = 800) {
    const startY = window.scrollY;
    const distance = targetY - startY;
    const startTime = performance.now();

    function animation(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1); // بين 0 و 1

        window.scrollTo(0, startY + distance * progress);

        if (progress < 1) {
            requestAnimationFrame(animation);
        }
    }

    requestAnimationFrame(animation);
}

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href");
        if (targetId === "#") return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            const targetY = targetElement.offsetTop;
            smoothScrollTo(targetY, 900); // <-- حط السرعة هنا (بالميلي ثانية)
        }
    });
});

// تطبيق التحسينات عند التحميل وعند تغيير حجم النافذة
window.addEventListener("load", handleResponsiveFeatures);
window.addEventListener("resize", handleResponsiveFeatures);
