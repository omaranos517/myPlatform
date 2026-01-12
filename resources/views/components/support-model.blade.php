<!-- Support Modal -->
<div id="supportModal" class="modal">
    <div class="modal-content">
        <span class="close-support-model" id="closeSupportModel">&times;</span>
        <h3><i class="fas fa-headset"></i> الإبلاغ عن مشكلة</h3>
        
        <form id="supportForm" action="{{ $guest ? route('guest.support.submit') : route('support.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($guest)
                <div class="form-group">
                    <label for="name">اسم المستخدم:</label>
                    <input type="text" id="name" name="name" placeholder="اسم المستخدم" required>
                </div>
                <div class="form-group">
                    <label for="PhoneNumber">رقم تلفونك عشان نقدر نتواصل معاك:</label>
                    <input type="text" id="PhoneNumber" name="phone" placeholder="رقم التلفون" required>
                </div>
            @endif
            
            <div class="form-group">
                <label for="issueType">نوع المشكلة:</label>
                <select id="issueType" name="issueType" required>
                    <option value="" disabled selected>اختر نوع المشكلة</option>
                    <option value="technical">مشكلة تقنية</option>
                    <option value="performance">مشكلة في السرعة</option>
                    <option value="content">مشكلة في المحتوى</option>
                    <option value="account">مشكلة في الحساب</option>
                    <option value="other">أخرى</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="issueDescription">وصف المشكلة:</label>
                <textarea id="issueDescription" name="issue" placeholder="صِف المشكلة التي تواجهها بالتفصيل..." required></textarea>
            </div>

            <div class="form-group">
                <label for="screenshot">إضافة صورة (اختياري):</label>
                <input type="file" id="screenshot" name="screenshot" accept="image/*">
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> إرسال البلاغ
            </button>
        </form>
    </div>
</div>
