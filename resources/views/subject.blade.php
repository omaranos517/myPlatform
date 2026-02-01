@extends('layouts.app')

@section('title', $subject['name'] . ' - ' . $settings->platform_name)

@section('content')
    <!-- Back Button -->
    @include('components.backBtn')
    <div class="lessons-container">
        @forelse($courses as $course)
            <div class="lesson-card">
                <div class="lesson-header">
                    <h3 class="lesson-title">{{ $course->title }}</h3>
                </div>
                <div class="lesson-content">
                    <p>{{ $course->description ?? 'لا يوجد وصف للكورس حتى الآن' }}</p>
                    <a href="{{ route('courses.show', $course->id) }}" class="video-link">
                        <i class="fas fa-arrow-circle-right"></i> استعراض الكورس
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>لا توجد كورسات متاحة حالياً</h3>
                <p>سيتم إضافة الكورسات قريباً بإذن الله</p>
            </div>
        @endforelse
    </div>

    <!-- back to top button -->
    @include('components.backToTopBtn')
    <script>
        // تشغيل تأثيرات الظهور عند التحميل
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.dispatchEvent(new Event('scroll'));
            }, 100);
        });
    </script>
@endsection

@php
    $showNavBtns = '';
    $footerExpanded = true;
@endphp

@pushOnce('styles')
    @vite([
        'resources/css/pages/subject.css',
        'resources/css/components/backBtn.css',
        'resources/css/components/backToTopBtn.css',
    ])
@endpushOnce
@pushOnce('scripts')
    @vite([
        'resources/js/pages/subject.js',
        'resources/js/components/backBtn.js',
        'resources/js/components/backToTopBtn.js',
    ])
@endpushOnce