// دالة تبديل عرض/إخفاء درس واحد
function toggleLesson(index) {
    const content = document.getElementById(`lessonContent${index}`);
    const toggleBtn = document.querySelector(
        `button[onclick="toggleLesson(${index})"]`,
    );

    content.classList.toggle("show");
    toggleBtn.classList.toggle("active");

    // تحديث أيقونة السهم
    const icon = toggleBtn.querySelector("i");
    if (content.classList.contains("show")) {
        icon.classList.remove("fa-chevron-down");
        icon.classList.add("fa-chevron-up");
    } else {
        icon.classList.remove("fa-chevron-up");
        icon.classList.add("fa-chevron-down");
    }
}

// دالة لفتح/إغلاق كل الدروس
document.addEventListener("DOMContentLoaded", function () {
    const toggleAllBtn = document.getElementById("toggleAllBtn");
    if (toggleAllBtn) {
        toggleAllBtn.addEventListener("click", function () {
            const allContents = document.querySelectorAll(".lesson-content");
            const allToggles = document.querySelectorAll(".lesson-toggle");
            const allIcons = document.querySelectorAll(".lesson-toggle i");

            // التحقق إذا كان هناك أي محتوى مفتوح
            const anyOpen = Array.from(allContents).some((content) =>
                content.classList.contains("show"),
            );

            if (anyOpen) {
                // إغلاق كل المحتوى
                allContents.forEach((content) =>
                    content.classList.remove("show"),
                );
                allToggles.forEach((toggle) =>
                    toggle.classList.remove("active"),
                );
                allIcons.forEach((icon) => {
                    icon.classList.remove("fa-chevron-up");
                    icon.classList.add("fa-chevron-down");
                });
                toggleAllBtn.innerHTML =
                    '<i class="fas fa-expand-alt"></i> فتح كل الدروس';
            } else {
                // فتح كل المحتوى
                allContents.forEach((content) => content.classList.add("show"));
                allToggles.forEach((toggle) => toggle.classList.add("active"));
                allIcons.forEach((icon) => {
                    icon.classList.remove("fa-chevron-down");
                    icon.classList.add("fa-chevron-up");
                });
                toggleAllBtn.innerHTML =
                    '<i class="fas fa-compress-alt"></i> إغلاق كل الدروس';
            }
        });
    }

    // فتح أول درس تلقائياً عند تحميل الصفحة
    const firstLessonContent = document.getElementById("lessonContent0");
    const firstToggleBtn = document.querySelector(
        'button[onclick="toggleLesson(0)"]',
    );
    if (firstLessonContent && firstToggleBtn) {
        firstLessonContent.classList.add("show");
        firstToggleBtn.classList.add("active");
        const firstIcon = firstToggleBtn.querySelector("i");
        firstIcon.classList.remove("fa-chevron-down");
        firstIcon.classList.add("fa-chevron-up");
    }
});
