@extends('layouts.error') {{-- نفترض لديك Layout عام للخطأ يستخدم CSS و JS المشتركين --}}

@section('error-code', '404')
@section('error-title', 'عذراً، الصفحة غير موجودة')
@section('error-description', 'الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى عنوان آخر.')
@section('error-icon', 'fas fa-exclamation-triangle')
