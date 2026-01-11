// المراجع
const nameEl = document.getElementById("name");
const passwordEl = document.getElementById("password");
const confirmEl = document.getElementById("confirm_password");
const phoneEl = document.getElementById("phone");
const parentPhoneEl = document.getElementById("parent_phone");
const stageEl = document.getElementById("stage");
const classEl = document.getElementById("class");
const eduTypeEl = document.getElementById("educational_type");
const sectionDiv = document.getElementById("sectionDiv");
const sectionEl = document.getElementById("section");
const errorBox = document.getElementById("errorBox");
const errorText = document.getElementById("errorText");
const passwordStrengthBar = document.getElementById("password-strength-bar");

// إضافة مستمعي الأحداث للحقول
nameEl.addEventListener("input", clearError);
phoneEl.addEventListener("input", clearError);
passwordEl.addEventListener("input", function () {
    clearError();
    checkPasswordStrength(this.value);
});
confirmEl.addEventListener("input", clearError);
parentPhoneEl.addEventListener("input", clearError);
stageEl.addEventListener("change", function () {
    clearError();
    toggleSection();
});
classEl.addEventListener("change", function () {
    clearError();
    toggleSection();
});
eduTypeEl.addEventListener("change", function () {
    clearError();
    toggleSection();
});
sectionEl.addEventListener("change", clearError);

// التحقق من قوة كلمة السر
function checkPasswordStrength(password) {
    // إعادة تعيين شريط القوة
    passwordStrengthBar.className = "password-strength-bar";

    if (password.length === 0) {
        return;
    }

    // حساب قوة كلمة السر
    let strength = 0;

    // إذا كانت تحتوي على أحرف صغيرة
    if (password.match(/[a-z]/)) strength++;

    // إذا كانت تحتوي على أحرف كبيرة
    if (password.match(/[A-Z]/)) strength++;

    // إذا كانت تحتوي على أرقام
    if (password.match(/[0-9]/)) strength++;

    // إذا كانت تحتوي على رموز خاصة
    if (password.match(/[^a-zA-Z0-9]/)) strength++;

    // إذا كانت طويلة بما فيه الكفاية
    if (password.length >= 8) strength++;

    // تحديث شريط القوة
    if (strength <= 2) {
        passwordStrengthBar.classList.add("weak");
    } else if (strength <= 4) {
        passwordStrengthBar.classList.add("medium");
    } else if (strength === 5) {
        passwordStrengthBar.classList.add("strong");
    } else {
        passwordStrengthBar.classList.add("very-strong");
    }
}

// إظهار / إخفاء القسم
function toggleSection() {
    if (
        stageEl.value === "إعدادية" ||
        (stageEl.value === "ثانوية" &&
            classEl.value === "الأول" &&
            eduTypeEl.value === "عام")
    ) {
        sectionDiv.style.display = "none";
        sectionEl.disabled = true;
        sectionEl.required = false;
        sectionEl.value = "علمي";
    } else {
        sectionDiv.style.display = "block";
        sectionEl.disabled = false;
        sectionEl.required = true;
        sectionEl.value = "";
    }
}

function showError(message) {
    errorText.textContent = message;
    errorBox.style.display = "flex";
    setTimeout(() => {
        clearError();
    }, 5000);
}

// مسح الخطأ
function clearError() {
    errorBox.style.display = "none";
    errorText.textContent = "";
}

// التحقق قبل الإرسال
function validateForm() {
    let cleanName = nameEl.value.replace(/\s+/g, "").toLowerCase();
    const parts = nameEl.value.trim().split(/\s+/);
    let cleanPass = passwordEl.value.toLowerCase();
    const compoundPrefixes = ["عبد", "نور", "علاء", "سيف", "زين", "شمس", "صدر"];
    let adjustedParts = [];
    const phonePattern = /^01[0125][0-9]{8}$/;

    if (cleanName === cleanPass) {
        showError("يجب أن تكون كلمة السر مختلفة عن الاسم");
        return false;
    }

    // دمج الأسماء المركبة الشائعة
    for (let i = 0; i < parts.length; i++) {
        if (compoundPrefixes.includes(parts[i]) && i + 1 < parts.length) {
            adjustedParts.push((parts[i] + " " + parts[i + 1]).trim());
            i++; // تخطّي الكلمة التالية لأنها اندمجت
        } else {
            adjustedParts.push(parts[i]);
        }
    }

    // التحقق من أن الاسم يحتوي على ثلاث أسامي على الأقل
    if (adjustedParts.length < 3) {
        showError("نريد الاسم الثلاثي على الأقل");
        return false;
    }

    // التحقق من طول كلمة السر
    if (passwordEl.value.length < 6) {
        showError("كلمة السر يجب أن تكون 6 أحرف أو أكثر");
        return false;
    }

    // منع الأرقام المكررة مثل 11111111111
    if (
        /^(\d)\1+$/.test(phoneEl.value) ||
        /^(\d)\1+$/.test(parentPhoneEl.value)
    ) {
        showError("رقم الهاتف غير صالح (أرقام مكررة)");
        return false;
    }

    // التحقق من صيغة رقم الهاتف
    if (
        !phonePattern.test(phoneEl.value) ||
        !phonePattern.test(parentPhoneEl.value)
    ) {
        showError("برجاء إدخال رقم هاتف صحيح");
        return false;
    }

    // منع رقم الطالب من أن يطابق رقم ولي الأمر
    if (phoneEl.value === parentPhoneEl.value) {
        showError("رقم الطالب لا يجب أن يطابق رقم ولي الأمر");
        return false;
    }

    // التحقق من تطابق كلمتي السر
    if (passwordEl.value !== confirmEl.value) {
        showError("كلمتا السر غير متطابقتين");
        return false;
    }

    return true;
}

// عند تحميل الصفحة
window.onload = function () {
    toggleSection();
};
