<footer>
    <div class="footer-content">
        <div class="footer-column">
            <h3 class="animate-fade-in-up">عن (اسم المنصة)</h3>
            <p class="animate-slide-in-right">منصة تعليمية متكاملة تخدم طلاب المرحلتين الإعدادية والثانوية بمختلف أنظمتها التعليمية. نقدم تعليمًا عالي الجودة بأسعار مناسبة.</p>
            <div class="newsletter-form animate-fade-in-up">
                <h4>اشترك في النشرة البريدية (قريبا)</h4>
                <div class="newsletter-input">
                    <input type="email" placeholder="بريدك الإلكتروني">
                    <div class="tooltip-wrapper">
                        <button type="submit" class="newsletter-button" disabled>اشتراك</button>
                        <span class="tooltip">الميزة قيد التطوير حالياً</span>
                    </div>
                </div>
                <p style="font-size: 0.8rem; opacity: 0.7;">سنرسل لك آخر التحديثات والعروض الخاصة</p>
            </div>
        </div>
        
        <div class="footer-column">
            <h3 class="animate-fade-in-up">روابط سريعة</h3>
            <div class="footer-links">
                <ul class="stagger-animation">
                    @if (($footerLinks ?? '') === 'main')
                        <li><a href="#hero"><i class="fas fa-home"></i> الرئيسية</a></li>
                        @guest
                            <li><a href="#features"><i class="fas fa-question-circle"></i> لماذا نختار (اسم المنصة)؟</a></li>
                        @endguest
                        @auth
                            <li><a href="#subjects"><i class="fas fa-book"></i> المواد الدراسية</a></li>
                        @endauth
                    @else
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> الرئيسية</a></li>
                        <li><a href="{{ route('home') }}#subjects"><i class="fas fa-book"></i> المواد الدراسية</a></li>
                        <li><a href="{{ route('home') }}#stats"><i class="fas fa-chart-line"></i> إحصائيات المنصة</a></li>
                    @endif
                    <li><a href="#"><i class="fas fa-envelope"></i> اتصل بنا</a></li>
                    <li><a href="#"><i class="fas fa-shield-alt"></i> سياسة الخصوصية</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-column">
            <h3 class="animate-fade-in-up">وسائل التواصل</h3>
            <p class="animate-slide-in-right">تواصل معنا عبر الوسائل التالية:</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/share/1Hoqd9YPM1/?mibextid=wwXIfr" class="social-icon facebook" target="_blank" data-delay="0.1" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com" class="social-icon instagram" target="_blank" data-delay="0.2" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://wa.me/201557582785?text=أنا%20طالب%20من%20منصة%20(اسم المنصة)%20وعايز%20أتواصل%20مع%20الدعم" 
                    class="social-icon whatsapp" 
                    target="_blank" data-delay="0.3" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://youtube.com" class="social-icon youtube" target="_blank" data-delay="0.4" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://twitter.com" class="social-icon twitter" target="_blank" data-delay="0.5" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            
            <div class="footer-links">
                <ul class="stagger-animation">
                    <li><a href="tel:201557582785"><i class="fas fa-phone"></i>2785 758 155 20+</a></li>
                    <li><a href="mailto:omaranos517@gmail.com"><i class="fas fa-envelope"></i>info@al-azhari.edu</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <button class="support-btn animate-pulse-slow" id="supportBtn">
        <i class="fas fa-headset"></i> الإبلاغ عن مشكلة
    </button>
    
    <div class="footer-bottom">
        <div class="copyright">
            <p>© 2025 نظام (اسم المنصة) التعليمي. جميع الحقوق محفوظة | تم التصميم والتطوير بواسطة <a href="https://omaranos517.vercel.app" target="_blank" rel="noopener noreferrer" id="designer-link">عمر عنوس</a>.</p>
        </div>
        
        <div class="footer-badges">
            <div class="badge">
                <i class="fas fa-lock"></i> آمن ومحمي
            </div>
            <div class="badge">
                <i class="fas fa-certificate"></i> جودة عالية
            </div>
            <div class="badge">
                <i class="fas fa-users"></i> مجتمع نشط
            </div>
        </div>
    </div>
</footer>
        
<!-- Support Modal -->
<div id="supportModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeSupportModel">&times;</span>
        <h3><i class="fas fa-headset"></i> الإبلاغ عن مشكلة</h3>
        
        <form id="supportForm" action="{{ route('support.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="issueType">نوع المشكلة:</label>
                <select id="issueType" name="issueType" required>
                    <option value="" disabled selected>اختر نوع المشكلة</option>
                    <option value="technical">مشكلة تقنية</option>
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
