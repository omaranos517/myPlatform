@if(session('status') || $message ?? false)
    @php
        $msg = $message ?? session('status');
        $alertType = $type ?? 'info'; // قيمة افتراضية
        
        // تحديد النوع تلقائياً من الرسالة إذا لم يكن محدداً
        if (!isset($type)) {
            $alertType = session('alert_type', 'info');
        }
    @endphp
    <div class="flash-message-screen" id="flashMessage">
        <div class="flash-message" role="alert">
            <div class="alert-content">
                @switch($alertType)
                    @case('success')
                        <div class="alert-icon {{ $alertType }}">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        @break
                    @case('error')
                        <div class="alert-icon {{ $alertType }}">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        @break
                    @case('warning')
                        <div class="alert-icon {{ $alertType }}">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        @break
                    @default
                        <div class="alert-icon info">
                            <i class="fas fa-info-circle"></i>
                        </div>
                @endswitch

                <h2><strong>{{ ucfirst($alertType) }}:</strong> {{ $msg }}</h2>
                
                @if(isset($details) && $details)
                    <p class="alert-details">{{ $details }}</p>
                @endif
                
                <div class="flash-message-buttons">
                    <button type="button" class="close" aria-label="Close">
                        <i class="fas fa-times"></i> إغلاق
                    </button>
                    
                    @if($alertType === 'error' || $alertType === 'warning')
                        <button class="support-btn animate-pulse-slow" id="supportBtn">
                            <i class="fas fa-headset"></i> الإبلاغ عن مشكلة
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif