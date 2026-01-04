// جعل الوضع النهاري هو الافتراضي
document.addEventListener("DOMContentLoaded", function () {
    toggleSection();
});

// إظهار/إخفاء القسم الدراسي بناءً على الاختيارات
function toggleSection() {
    const stage = document.getElementById("stage");
    const classSelect = document.getElementById("class");
    const eduType = document.getElementById("educational_type");
    const sectionField = document.getElementById("section-field");

    if (stage && classSelect && eduType && sectionField) {
        if (
            stage.value === "إعدادية" ||
            (stage.value === "ثانوية" &&
                classSelect.value === "الأول" &&
                eduType.value === "عام")
        ) {
            sectionField.style.display = "none";
        } else {
            sectionField.style.display = "block";
        }
    }
}

// تبديل وضع التعديل
function toggleEditMode(formId, infoId) {
    document.getElementById(formId).style.display = "block";
    document.getElementById(infoId).style.display = "none";
}

// إلغاء التعديل
function cancelEdit(formId, infoId) {
    document.getElementById(formId).style.display = "none";
    document.getElementById(infoId).style.display = "block";
}

// تأكيد حذف الحساب
function confirmDelete() {
    if (
        confirm(
            "هل أنت متأكد من أنك تريد حذف حسابك؟ هذا الإجراء لا يمكن التراجع عنه.",
        )
    ) {
        alert("سيتم توجيهك إلى صفحة تأكيد حذف الحساب");
        // يمكن توجيه المستخدم إلى صفحة حذف الحساب هنا
        // window.location.href = 'delete_account.php';
    }
}

// تبديل إظهار/إخفاء كلمة المرور
document.querySelectorAll(".input-icon").forEach((icon) => {
    const input = icon.querySelector('input[type="password"]');
    if (input) {
        const toggle = document.createElement("span");
        toggle.className = "password-toggle";
        toggle.innerHTML = '<i class="fas fa-eye"></i>';
        toggle.style.cursor = "pointer";
        toggle.style.position = "absolute";
        toggle.style.left = "15px";
        toggle.style.top = "50%";
        toggle.style.transform = "translateY(-50%)";

        toggle.addEventListener("click", function () {
            const type =
                input.getAttribute("type") === "password" ? "text" : "password";
            input.setAttribute("type", type);

            const eyeIcon = this.querySelector("i");
            eyeIcon.classList.toggle("fa-eye");
            eyeIcon.classList.toggle("fa-eye-slash");
        });

        icon.appendChild(toggle);
    }
});
