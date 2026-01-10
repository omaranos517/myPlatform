<footer>
    <div class="footer-content">
        <div class="footer-column">
            <h3 class="animate-fade-in-up">عن {{ $platformName }}</h3>
            <p class="animate-slide-in-right">{{ $description }}</p>
            <div class="newsletter-form animate-fade-in-up">
                <h4>اشترك في النشرة البريدية <span style="opacity: 0.6;">(قريباً)</span></h4>
                <div class="newsletter-input">
                    <input type="email" placeholder="بريدك الإلكتروني">
                    <div class="tooltip-wrapper">
                        <button type="submit" class="newsletter-button" disabled>اشتراك</button>
                        <span class="tooltip">الميزة قيد التطوير حالياً</span>
                    </div>
                </div>
                <p style="font-size: 0.8rem; opacity: 0.7;">سنرسل لك آخر التحديثات والعروض الخاصة</p>
                <p>the value of footerLinks is: {{ $footerLinks }}</p>
            </div>
        </div>
        
        <div class="footer-column">
            <h3 class="animate-fade-in-up">روابط سريعة</h3>
            <div class="footer-links">
                <ul class="stagger-animation">
                    @if (($footerLinks ?? '') === 'main')
                        <li><a href="#hero"><i class="fas fa-home"></i> الرئيسية</a></li>
                        @guest
                            <li><a href="#features"><i class="fas fa-question-circle"></i> لماذا نختار {{ $platformName }}؟</a></li>
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
                @foreach ($socialLinks as $platform => $link)
                    <a href="{{ $link }}" class="social-icon {{ $platform }}" target="_blank" data-delay="0.1" aria-label="{{ ucfirst($platform) }}">
                        <i class="fab fa-{{ $platform }}"></i>
                    </a>
                @endforeach
            </div>
            
            <div class="footer-links">
                <ul class="stagger-animation">
                    <li><a href="tel:{{ $phone }}"><i class="fas fa-phone"></i>{{ $phone }}</a></li>
                    <li><a href="mailto:{{ $email }}"><i class="fas fa-envelope"></i>{{ $email }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <button class="support-btn animate-pulse-slow" id="supportBtn">
        <i class="fas fa-headset"></i> الإبلاغ عن مشكلة
    </button>
    
    <div class="footer-bottom">
        <div class="copyright">
            <p>© <span id="year"></span> نظام {{ $platformName }} التعليمي. جميع الحقوق محفوظة | تم التصميم والتطوير بواسطة <a href="{{ $designerLink }}" target="_blank" rel="noopener noreferrer" id="designer-link">{{ $designerName }}</a>.</p>
        </div>
        
        <div class="footer-badges">
            @foreach ($badges as $badge)
                <div class="badge">
                    <i class="fas fa-{{ $badge['icon'] }}"></i> {{ $badge['text'] }}
                </div>
            @endforeach
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
