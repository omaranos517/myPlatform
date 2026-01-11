const supportModal = document.getElementById("supportModal");
const supportBtn = document.getElementById("supportBtn");
const closeSupportBtn = document.getElementById("closeSupportModel");
// فتح نافذة الدعم الفني عند النقر على الزر
supportBtn.addEventListener("click", openSupportModal);

// إغلاق نافذة الدعم الفني عند النقر على زر الإغلاق
closeSupportBtn.addEventListener("click", closeSupportModal);


// فتح نافذة الدعم الفني
function openSupportModal() {
    document.getElementById("supportModal").style.display = "block";
    console.log("supportModal opened");
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

// إغلاق modal عند الضغط على زر Escape
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeSupportModal();
    }
});
