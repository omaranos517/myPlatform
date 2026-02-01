<div class="subject-card animate-on-scroll" style="transition-delay: {{ $index * 0.1 }}s">
    <div class="subject-card-header">
        <i class="fas fa-book"></i>
    </div>

    <div class="subject-card-body">
        <h3>{{ $subject->name }}</h3>
        <p>استعد للتميز في هذه المادة مع أفضل المدرسين</p>
        <a href="{{ route('subjects.show', $subject) }}" class="subject-link">
            ابدأ التعلم الآن
        </a>
    </div>
</div>
