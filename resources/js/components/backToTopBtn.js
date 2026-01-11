const backToTopBtn = document.getElementById("backToTop");

window.addEventListener("scroll", function () {
    const scrollPosition = window.scrollY;

    // إظهار أو إخفاء زر العودة للأعلى
    const backToTopBtn = document.getElementById("backToTop");
    if (scrollPosition > 300) {
        backToTopBtn.classList.add("show");
    } else {
        backToTopBtn.classList.remove("show");
    }
});

// تحسين تأثيرات الزر العودة للأعلى
document.getElementById("backToTop").addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});
