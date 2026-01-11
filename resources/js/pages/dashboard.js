// عرض التاريخ الحالي
function updateDate() {
    const now = new Date();
    const days = [
        "الأحد",
        "الاثنين",
        "الثلاثاء",
        "الأربعاء",
        "الخميس",
        "الجمعة",
        "السبت",
    ];
    const months = [
        "يناير",
        "فبراير",
        "مارس",
        "أبريل",
        "مايو",
        "يونيو",
        "يوليو",
        "أغسطس",
        "سبتمبر",
        "أكتوبر",
        "نوفمبر",
        "ديسمبر",
    ];

    document.getElementById("current-day").textContent = days[now.getDay()];
    document.getElementById("current-date").textContent =
        `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
}

function fetchStats() {
    fetch(window.statsUrl)
        .then((response) => response.json())
        .then((data) => {
            document.querySelector(".stat-card:nth-child(1) h3").textContent =
                data.studentCount;
            document.querySelector(".stat-card:nth-child(2) h3").textContent =
                data.subjectCount;
            document.querySelector(".stat-card:nth-child(3) h3").textContent =
                data.lessonCount;
            document.querySelector(".stat-card:nth-child(4) h3").textContent =
                data.adminCount;
        })
        .catch((err) => console.error("Error fetching stats:", err));
    console.log("it is work");
}

// تحديث الإحصائيات عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", function () {
    fetchStats();
    // تحديث كل 30 ثانية (اختياري)
    setInterval(fetchStats, 30000);

    // تحديث التاريخ عند تحميل الصفحة
    updateDate();

    // إضافة تأثيرات عند التمرير
    const cards = document.querySelectorAll(".card");
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1 + 0.5}s`;
    });
});
