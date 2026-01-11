// إضافة JavaScript لإدارة التفاعل
document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.querySelector('.flash-message-screen');
    const closeBtn = document.querySelector('.close');
    
    if (flashMessage && closeBtn) {
        // إغلاق الرسالة عند النقر على زر الإغلاق
        closeBtn.addEventListener('click', function() {
            flashMessage.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(() => {
                flashMessage.remove();
            }, 300);
        });
        
        // إغلاق الرسالة عند النقر خارجها
        flashMessage.addEventListener('click', function(e) {
            if (e.target === flashMessage) {
                closeBtn.click();
            }
        });
        
        // إغلاق الرسالة باستخدام زر Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && flashMessage) {
                closeBtn.click();
            }
        });
        
        // إغلاق تلقائي بعد 5 ثواني للرسائل الناجحة فقط
        const alertType = document.querySelector('.alert-icon')?.className.includes('success');
        if (alertType) {
            setTimeout(() => {
                closeBtn.click();
            }, 5000);
        }
    }
});