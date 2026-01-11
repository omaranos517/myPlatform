@extends('layouts.app')

@section('title', $course->title . ' - ' . $settings->platform_name)

@section('content')
    <!-- Back Button -->
    @include('partials.backBtn')
    <div class="course-container">
        <h2 class="course-title">{{ $course->title }}</h2>
        <p class="course-description">{{ $course->description ?? 'لا يوجد وصف للكورس' }}</p>

        <h3>الدروس المرتبطة بهذا الكورس</h3>
        
        @if($course->lessons->count() > 0)
        <button class="toggle-all-btn" id="toggleAllBtn">
            <i class="fas fa-expand-alt"></i>
            فتح/إغلاق كل الدروس
        </button>
        @endif
        
        <div class="lessons-container">
            @forelse($course->lessons as $index => $lesson)
                <div class="lesson-wrapper">
                    <button class="lesson-toggle" onclick="toggleLesson({{ $index }})">
                        <span>{{ $index + 1 }}. {{ $lesson->title }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    
                    <div class="lesson-content" id="lessonContent{{ $index }}">
                        <p>{{ $lesson->description ?? 'لا يوجد وصف للدرس' }}</p>
                        
                        @if($lesson->explanation_url || $lesson->solution_url)
                        <div class="lesson-links">
                            @if($lesson->explanation_url)
                                <a href="{{ $lesson->explanation_url }}" class="video-link" target="_blank">
                                    <i class="fas fa-play-circle"></i> مشاهدة الشرح
                                </a>
                            @endif
                            
                            @if($lesson->solution_url)
                                <a href="{{ $lesson->solution_url }}" class="solution-link" target="_blank">
                                    <i class="fas fa-file-alt"></i> مشاهدة الحل
                                </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h4>لا توجد دروس لهذا الكورس حتى الآن</h4>
                    <p>سيتم إضافة الدروس قريباً بإذن الله</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Back To Top -->
    @include('partials.backToTopBtn')
@endsection

@php
    $showNavBtns = '';
    $footerExpanded = true;
@endphp

@pushOnce('styles')
    @vite([
        'resources/css/pages/course.css',
        'resources/css/components/backBtn.css',
        'resources/css/components/backToTopBtn.css',
    ])
@endpushOnce
@pushOnce('scripts')
    @vite([
        'resources/js/pages/course.js',
        'resources/js/components/backBtn.js',
        'resources/js/components/backToTopBtn.js',
    ])
@endpushOnce