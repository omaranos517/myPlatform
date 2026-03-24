// fill_signup.js
document.addEventListener("DOMContentLoaded", () => {

    // قوائم البيانات
    const males = ["عمر","أحمد","محمد","ايهاب","أكرم","حسن","أيمن","محمود","عبد المنعم","مدحت","عبد الرحمن","عبد الله","عبد العزيز","عبد القادر","عبد الغني","عبد الحليم","عبد الوهاب","عبد الرزاق"];
    const females = ["سارة","نور","مريم","هند","فاطمة","أسماء","ريم","ليلى","دينا","رنا","سلمى","هالة","نجلاء","رغدة","سعاد","عائشة","جميلة","رقيه","سحر","نادية"];
    const stages = ["إعدادية","ثانوية"];
    const classes = ["الأول","الثاني","الثالث"];
    const educational_types = ["أزهري","عام"];
    const sections = ["علمي","أدبي"];

    // توليد اسم ثلاثي
    function generateFullName() {
        const first = [...males, ...females][Math.floor(Math.random() * (males.length + females.length))];
        const [father, family] = shuffleArray(males).slice(0,2);
        return `${first} ${father} ${family}`;
    }

    // توليد رقم هاتف مصري صحيح
    function generatePhone() {
        const prefix = ["010","011","012","015"][Math.floor(Math.random()*4)];
        const suffix = Array.from({length:8}, ()=>Math.floor(Math.random()*10)).join('');
        return prefix + suffix;
    }

    // توليد كلمة سر قوية
    function generatePassword(length=8) {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?/~`";
        return Array.from({length}, ()=>chars[Math.floor(Math.random()*chars.length)]).join('');
    }

    // خلط array
    function shuffleArray(array) {
        return array.sort(() => Math.random() - 0.5);
    }

    // تعبئة الحقول تلقائيًا
    function fillForm() {
        const nameInput = document.getElementById("name");
        const phoneInput = document.getElementById("phone");
        const parentInput = document.getElementById("parent_phone");
        const passwordInput = document.getElementById("password");
        const confirmInput = document.getElementById("confirm_password");
        const stageSelect = document.getElementById("stage");
        const classSelect = document.getElementById("class");
        const typeSelect = document.getElementById("educational_type");
        const sectionSelect = document.getElementById("section");
        const checkbox = document.getElementById("is_language");

        const password = generatePassword();

        if(nameInput) nameInput.value = generateFullName();
        if(phoneInput) phoneInput.value = generatePhone();
        if(parentInput) parentInput.value = generatePhone();
        if(passwordInput) passwordInput.value = password;
        if(confirmInput) confirmInput.value = password;
        if(stageSelect) stageSelect.value = stages[Math.floor(Math.random()*stages.length)];
        if(classSelect) classSelect.value = classes[Math.floor(Math.random()*classes.length)];
        if(typeSelect) typeSelect.value = educational_types[Math.floor(Math.random()*educational_types.length)];
        if(sectionSelect) sectionSelect.value = sections[Math.floor(Math.random()*sections.length)];
        if(checkbox) checkbox.checked = Math.random() < 0.5;
    }

    // زر سريع لتعبئة الفورم
    const fillBtn = document.createElement("button");
    fillBtn.textContent = "املأ البيانات تلقائيًا";
    fillBtn.type = "button";
    fillBtn.style.margin = "10px";
    fillBtn.onclick = fillForm;

    const formContainer = document.querySelector(".form-container form");
    if(formContainer) formContainer.prepend(fillBtn);

});