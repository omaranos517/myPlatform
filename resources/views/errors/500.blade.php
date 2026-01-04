@extends('layouts.error')

@section('error-code', '500')
@section('error-title', 'خطأ داخلي في الخادم')
@section('error-description', 'حدث خطأ غير متوقع في الخادم. يرجى المحاولة لاحقًا.')
@section('error-icon', 'fas fa-server')
